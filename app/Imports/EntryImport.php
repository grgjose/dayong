<?php

namespace App\Imports;

use DateTime;
use App\Models\ExcelEntries;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use PHPUnit\Exception;

class EntryImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        if(trim(strtolower($row[0])) == "timestamp")
        {
            return null;
        }
        elseif(trim($row[0]) == "" || $row[0] == null)
        {
            return null;
        }
        else
        {
            return new ExcelEntries([
                'timestamp' => $row[0],
                'branch' => $row[1],
                'marketting_agent' => $row[2],
                'status' => $row[3],
                'phmember' => $row[4],
                'or_number' => $row[5],
                'or_date' => $row[6],
                'amount_collected' => $row[7],
                'month_of' => $row[8],
                'nop' => $row[9],
                'date_remitted' => $row[10],
                'dayong_program' => $row[11],
                'reactivation' => $row[12],
                'transferred' => $row[13],
            ]);
        }
    }

    public function excelTimestampToString($excelTimestamp) 
    {
        // Define the base date for Excel dates (January 1, 1900 is considered day 1 in Excel)
        $excelEpoch = new DateTime('1899-12-30'); // Excel date 0 corresponds to 1899-12-30
        
        // Separate the integer part (days) and fractional part (time)
        $days = floor($excelTimestamp);
        $fractionalDay = $excelTimestamp - $days;
        
        // Add the days to the epoch
        $excelEpoch->modify("+{$days} days");
        
        // Calculate the time from the fractional day
        $totalSeconds = round($fractionalDay * 86400); // 86400 seconds in a day
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        
        // Add the time to the date
        $excelEpoch->setTime($hours, $minutes, $seconds);
        
        // Return the formatted date string
        return $excelEpoch->format('Y-m-d H:i:s');
    }
}
