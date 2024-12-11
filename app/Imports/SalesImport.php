<?php

namespace App\Imports;

use DateTime;
use App\Models\ExcelMembers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class SalesImport implements ToModel
{
    use Importable;

    public function model (array $row)
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
            return new ExcelMembers([
                'timestamp' => $row[0],    
                'branch' => $row[1],
                'marketting_agent' => $row[2],
                'status' => $row[3],
                'phmember' => $row[4],
                'address' => $row[5],
                'civil_status' => $row[6],
                'birthdate' => $row[7],
                'age' => $row[8],
                'name' => $row[9],
                'contact_no' => $row[10],
                'type_of_transaction' => $row[11],
                'with_registration_fee' => $row[12],
                'registration_amount' => $row[13],
                'dayong_program' => $row[14],
                'application_no' => $row[15],
                'or_number' => $row[16],
                'or_date' => $row[17],
                'amount_collected' => $row[18],
                'name1' => $row[19],
                'age1' => $row[20],
                'relationship1' => $row[21],
                'name2' => $row[22],
                'age2' => $row[23],
                'relationship2' => $row[24],
                'name3' => $row[25],
                'age3' => $row[26],
                'relationship3' => $row[27],
                'name4' => $row[28],
                'age4' => $row[29],
                'relationship4' => $row[30],
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
