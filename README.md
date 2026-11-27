### PHP Time Ago

A lightweight PHP library that converts dates and times into human-readable relative time in Kurdish (Sorani). Supports past and future dates, including years, months, weeks, days, hours, minutes, and seconds.

### Features

* Simple and easy to use
* Supports past and future dates
* Supports DateTime objects
* Lightweight with no external dependencies
* Customizable output
* Easy integration into any PHP project

## Requirements

* PHP 7.4 or higher


## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/8a1wkar/REPOSITORY.git
   ```

2. **Include the library in your PHP project:**

   ```php
   require_once 'time-ago.php';
   ```


## Usage

```php
echo time_elapsed_string('2026-11-26 10:00:00');
```

You can also use a DateTime object:

```php
$date = new DateTime('2026-11-26 10:00:00');
echo time_elapsed_string($date);
```


### Example Output

1 day ago
<br>
2 hours ago
<br>
Just now

Output depends on the current date and time.

## Testing

The library includes example code for testing different dates and checking the generated relative time.

## License

This project is licensed under the MIT License.
