# meeting-doctors-test
Test from Meeting Doctors

## Installation

First run 

```bash
composer install
```
That will install Laravel and all dependencies

## Usage

```bash
php artisan csv:generate
```

Will run a command that will process an **xml file** located in storage/app/XmlFiles if there is one (should be previously uploaded on the index view), and will consume the endpoint https://jsonplaceholder.typicode.com/users.

After that the command will produce an outoput **csv file** located in storage/app/outputCsv, all the output files will be downloadable at the /CsvFiles view, from the index view you can acces to it.


