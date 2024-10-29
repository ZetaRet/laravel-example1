<?php
namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Requests\FormDataRequest;
use App\Models\User;
use App\Models\Phones;
use Illuminate\Support\Collection;

class FormController extends Controller
{

    public function show(): View
    {
        return view('formdata');
    }

    public function create(FormDataRequest $request): View
    {
        $validated = $request->validated();
        $input = $request->all();

        $user = new User();
        $user->password = 'nopassword';
        $user->name = self::escapeStringDB($input['name']);
        $user->name_parent = self::escapeStringDB($input['name_parent']);
        $user->name_family = self::escapeStringDB($input['name_family']);
        $user->email = self::escapeStringDB($input['email']);
        $user->identity_number = self::escapeStringDB($input['identity_number']);
        $user->civil_id = self::escapeStringDB($input['civil_id']);
        $user->save();
        $userid = $user->id;

        if (! empty($input['phone_number_public'])) {
            self::createPhone($userid, 'public', $input['phone_ext_public'], $input['phone_number_public']);
        }
        if (! empty($input['phone_number_private'])) {
            self::createPhone($userid, 'private', $input['phone_ext_private'], $input['phone_number_private']);
        }
        if (! empty($input['phone_number_home'])) {
            self::createPhone($userid, 'home', $input['phone_ext_home'], $input['phone_number_home']);
        }
        if (! empty($input['phone_number_office'])) {
            self::createPhone($userid, 'office', $input['phone_ext_office'], $input['phone_number_office']);
        }
        if (! empty($input['phone_number_work'])) {
            self::createPhone($userid, 'work', $input['phone_ext_work'], $input['phone_number_work']);
        }

        return view('formdata')->with('formMessage', 'Form Submit Success');
    }

    private function createPhone(string $userid, string $type, string $ext, string $number): Phones
    {
        $phones = new Phones();
        $phones->user_id = $userid;
        $phones->phone_type = $type;
        $phones->phone_ext = self::escapeStringDB($ext);
        $phones->phone_number = self::escapeStringDB($number);
        $phones->save();

        return $phones;
    }

    private function escapeStringDB(string $v): string
    {
        $ev = str_replace(';', '', $v);
        return $ev;
    }

    public function paginator(string $page = ''): View
    {
        $paginateData = array();
        if (! $page)
            $page = '1';
        $intPage = intval($page);
        if ($intPage < 1)
            $intPage = 1;
        $limit = 5;
        $paginate = self::getPaginate($limit, $intPage);
        $paginateData['limit'] = $limit;
        $paginateData['items'] = $paginate->items();
        $paginateData['total'] = $paginate->total();
        $paginateData['count'] = $paginate->count();
        $paginateData['page'] = $paginate->currentPage();
        $paginateData['pages'] = ceil($paginateData['total'] / $limit);
        $paginateData['page_prev'] = $paginateData['page'] > 1 ? $paginateData['page'] - 1 : 1;
        $paginateData['page_next'] = $paginateData['page'] < $paginateData['pages'] ? $paginateData['page'] + 1 : $paginateData['pages'];
        $paginateData['phones'] = self::addPhonesToUsers($paginateData['items']);

        return view('paginator')->with('paginateData', $paginateData);
    }

    private function getPaginate(int $limit, int $intPage)
    {
        $paginate = User::orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate($limit, ['*'], 'page', $intPage);
        return $paginate;
    }

    private function addPhonesToUsers($users): array
    {
        $phones = array();
        $userids = array();
        $usermap = array();
        foreach ($users as $user) {
            $userid = $user->id;
            array_push($userids, $userid);
            $phones[$userid] = array();
            $usermap[$userid] = $user;
        }
        $phonesget = Phones::whereIn('user_id', $userids)->get();
        foreach ($phonesget as $phone) {
            array_push($phones[$phone['user_id']], $phone);
            $user = $usermap[$phone['user_id']];
            $user[$phone->phone_type] = $phone;
            if (empty($user['phone1']))
                $user['phone1'] = $phone;
            else if (empty($user['phone2']))
                $user['phone2'] = $phone;
        }

        return $phones;
    }

    private function getUserArrayCSV(User $user): array
    {
        $userArr = array();
        array_push($userArr, $user->id);
        array_push($userArr, $user->name);
        array_push($userArr, $user->name_parent);
        array_push($userArr, $user->name_family);
        array_push($userArr, $user->email);
        array_push($userArr, $user->identity_number);
        array_push($userArr, $user->civil_id);
        array_push($userArr, $user->created_at);
        if (! empty($user['public'])) {
            array_push($userArr, $user['public']->phone_ext);
            array_push($userArr, $user['public']->phone_number);
        } else {
            array_push($userArr, '', '');
        }
        if (! empty($user['private'])) {
            array_push($userArr, $user['private']->phone_ext);
            array_push($userArr, $user['private']->phone_number);
        } else {
            array_push($userArr, '', '');
        }
        if (! empty($user['home'])) {
            array_push($userArr, $user['home']->phone_ext);
            array_push($userArr, $user['home']->phone_number);
        } else {
            array_push($userArr, '', '');
        }
        if (! empty($user['office'])) {
            array_push($userArr, $user['office']->phone_ext);
            array_push($userArr, $user['office']->phone_number);
        } else {
            array_push($userArr, '', '');
        }
        if (! empty($user['work'])) {
            array_push($userArr, $user['work']->phone_ext);
            array_push($userArr, $user['work']->phone_number);
        } else {
            array_push($userArr, '', '');
        }
        return $userArr;
    }

    private $contentArr = array();

    public function csvExport()
    {
        $fields = array(
            'id',
            'name',
            'name_parent',
            'name_family',
            'email',
            'identity_number',
            'civil_id',
            'created_at',
            'phone_ext_public',
            'phone_number_public',
            'phone_ext_private',
            'phone_number_private',
            'phone_ext_home',
            'phone_number_home',
            'phone_ext_office',
            'phone_number_office',
            'phone_ext_work',
            'phone_number_work',
        );
        array_push($this->contentArr, implode(';', $fields));

        User::orderBy('created_at', 'desc')->orderBy('id', 'desc')->chunk(100, function (Collection $users) {
            $phones = self::addPhonesToUsers($users);
            foreach ($users as $user) {
                $userArr = self::getUserArrayCSV($user);
                array_push($this->contentArr, implode(';', $userArr));
            }
        });

        $content = implode(PHP_EOL, $this->contentArr);
        $this->contentArr = array();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laravel_example1_data.csv"',
        ];
        return response($content, 200, $headers);
    }


}

?>