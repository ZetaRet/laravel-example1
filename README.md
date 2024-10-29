## Setup

Read the `setup.md` and choose the steps missing on your computer to finalize the install.  

## Main Page

Choose `Form Data` to fill in data records one by one.  
`Paginate Results` shows 5 records per page and navigation buttons to browse the database.  
`Export to CSV` will generate by using chunk of 100 records .csv file for download, use spreadsheet software to view.  

## Models

`User` model is extended to support identity personal data. New model `Phones` with table is created and typing for public, private, home, office, work.  

## Seeding

Seeding the database using `php artisan db:seed --class=UserSeeder` for 10 records, change the class to `UserSeeder100` to generate 100 records or type `php artisan db:seed --class=UserSeederReset` to delete the database seeded records and reset the ids. Automate more seeding using the hundred generator or extend by creating a new seeder `php artisan make:seeder UserSeeder10000` i.e. edit the limit or implement.  
Users are generated using imaginary gambled usernames, unique random emails, random identity and 5 phones with random digits. Mapping and bulk insert db operation.  
