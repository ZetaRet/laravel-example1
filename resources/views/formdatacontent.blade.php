<div>
<h1>Form Data</h1>
<div id="form-messages">
@if(!empty($formMessage))
{{ $formMessage }}
@endif
</div>
<div id="form-errors">
@if($errors->any())
{{ implode('', $errors->all(':message')) }}
@endif
</div>
<div id="form-data">
<form method="POST" action="/formdata/create">
@csrf
<label for="name">Name:</label><br/>
<input type="text" id="name" name="name" value="{{ old('name') }}" required minlength="2" maxlength="15"/><br/>
<label for="name_parent">Second Name:</label><br/>
<input type="text" id="name_parent" name="name_parent" value="{{ old('name_parent') }}" required minlength="2" maxlength="15"/><br/>
<label for="name_family">Family Name:</label><br/>
<input type="text" id="name_family" name="name_family" value="{{ old('name_family') }}" required minlength="2" maxlength="15"/><br/>
<label for="email">Email:</label><br/>
<input type="email" id="email" name="email" value="{{ old('email') }}" required minlength="8" maxlength="50"/><br/>
<label for="identity_number">Identity Number:</label><br/>
<input type="text" id="identity_number" name="identity_number" value="{{ old('identity_number') }}" required minlength="14" maxlength="14" pattern="[0-9]+" placeholder="Input 14 digits"/><br/>
<label for="civil_id">Civil ID:</label><br/>
<input type="text" id="civil_id" name="civil_id" value="{{ old('civil_id') }}" required minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<label for="name">Public Phone Ext:</label><br/>
<input type="text" id="phone_ext_public" name="phone_ext_public" value="{{ old('phone_ext_public') }}" minlength="3" maxlength="3"pattern="[0-9]+" placeholder="Input 3 digits"/><br/>
<label for="name">Public Phone Number:</label><br/>
<input type="text" id="phone_number_public" name="phone_number_public" value="{{ old('phone_number_public') }}" minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<label for="name">Private Phone Ext:</label><br/>
<input type="text" id="phone_ext_private" name="phone_ext_private" value="{{ old('phone_ext_private') }}" minlength="3" maxlength="3"pattern="[0-9]+" placeholder="Input 3 digits"/><br/>
<label for="name">PrivatePhone Number:</label><br/>
<input type="text" id="phone_number_private" name="phone_number_private" value="{{ old('phone_number_private') }}" minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<label for="name">Home Phone Ext:</label><br/>
<input type="text" id="phone_ext_home" name="phone_ext_home" value="{{ old('phone_ext_home') }}" minlength="3" maxlength="3"pattern="[0-9]+" placeholder="Input 3 digits"/><br/>
<label for="name">Home Phone Number:</label><br/>
<input type="text" id="phone_number_home" name="phone_number_home" value="{{ old('phone_number_home') }}" minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<label for="name">Office Phone Ext:</label><br/>
<input type="text" id="phone_ext_office" name="phone_ext_office" value="{{ old('phone_ext_office') }}" minlength="3" maxlength="3"pattern="[0-9]+" placeholder="Input 3 digits"/><br/>
<label for="name">Office Phone Number:</label><br/>
<input type="text" id="phone_number_office" name="phone_number_office" value="{{ old('phone_number_office') }}" minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<label for="name">Work Phone Ext:</label><br/>
<input type="text" id="phone_ext_work" name="phone_ext_work" value="{{ old('phone_ext_work') }}" minlength="3" maxlength="3"pattern="[0-9]+" placeholder="Input 3 digits"/><br/>
<label for="name">Work Phone Number:</label><br/>
<input type="text" id="phone_number_work" name="phone_number_work" value="{{ old('phone_number_work') }}" minlength="11" maxlength="11" pattern="[0-9]+" placeholder="Input 11 digits"/><br/>
<br/>
<button type="submit">Submit</button>
</form>
</div>
<br/>
<div class="back-main">
<a href="/">Back to main</a>
</div>
</div>