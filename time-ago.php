
<?php

/**
 * PHP Time Ago - Kurdish (Sorani) Library
 *
 * Converts dates and times into human-readable
 * relative time expressions in Kurdish (Sorani).
 *
 * Supports past and future dates, including:
 * Years, months, weeks, days, hours, minutes, and seconds.
 *
 * @author 8a1wkar
 * @version 1.0.0
 * @license MIT
 *
 * @param string|DateTimeInterface $datetime The date and time to convert.
 * @param bool $full Whether to display all available time units.
 *
 * @return string The formatted relative time in Kurdish (Sorani).
 */

function time_elapsed_string($datetime, $full = false)
{
    // Validate input
    if (
        !is_string($datetime) &&
        !($datetime instanceof DateTimeInterface)
    ) {
        return 'بەروار نادروستە';
    }

    if (is_string($datetime) && trim($datetime) === '') {
        return 'بەروار نادروستە';
    }

    // Parse datetime safely
    try {
        if ($datetime instanceof DateTimeInterface) {
            $date = DateTimeImmutable::createFromInterface($datetime);
        } else {
            $date = new DateTimeImmutable($datetime);
        }

        $now = new DateTimeImmutable('now', $date->getTimezone());

    } catch (Exception $e) {
        return 'بەروار نادروستە';
    }

    // Determine past or future
    $isFuture = $date > $now;

    // Calculate difference
    $diff = $date->diff($now);

    // Calculate weeks and remaining days
    $weeks = intdiv($diff->d, 7);
    $days = $diff->d % 7;

    // Time units
    $units = array(
        array($diff->y, 'ساڵ'),
        array($diff->m, 'مانگ'),
        array($weeks, 'هەفتە'),
        array($days, 'ڕۆژ'),
        array($diff->h, 'کاتژمێر'),
        array($diff->i, 'خولەک'),
        array($diff->s, 'چرکە')
    );

    $parts = array();

    // Build result
    foreach ($units as $unit) {

        $value = $unit[0];
        $label = $unit[1];

        if ($value > 0) {

            $parts[] = $value . ' ' . $label;

            if (!$full) {
                break;
            }
        }
    }

    // Just now
    if (empty($parts)) {
        return 'هەر ئێستا';
    }

    // Format output
    $result = implode('، ', $parts);

    if ($isFuture) {
        return $result . ' ماوە';
    }

    return $result . ' پێش ئێستا';
}


// ==========================================
// Example Usage & Output
//==========================================
$dates = [
    '10-10-2025 03:40:00',
    '15-05-2022 12:30:00',
    '20-08-2026 18:45:00',
    '20-11-2026 03:40:00',
];

foreach ($dates as $date) {

    $datetime = DateTime::createFromFormat(
        '!d-m-Y H:i:s',
        $date
    );

    if ($datetime === false) {
        echo 'Invalid date: ' . htmlspecialchars($date) . '<br>';
        continue;
    }

    echo htmlspecialchars($date) . ' → ';

    echo htmlspecialchars(
        time_elapsed_string($datetime)
    );

    echo '<br>';
}

?>