<html>
    <head><title>Date Time Processing</title></head>
    <body>
        <?php
        $name = $_GET["yourName"];
        $day = $_GET["day"]; $month = $_GET["month"]; $year= $GET["year"];
        $hour = $_GET["hour"]; $minute = $_GET["minute"]; $second= $GET["second"];
        print ("Enter your name and select date and time for a appointment <br></br>");
        print ("Hi $name! <br></br>");
        
        for ($hour = 0; $hour <= 23; $hour++){
            print ("$hour");
        }
        
        for ($minute = 0; $minute <= 59; $minute++){
            print ("$minute");
        }
        
        for ($second = 0; $second <= 59; $second++){
            print ("$second");
        }
        
        for ($day = 1; $day <= 31; $day++){
            print ("$day");
        }
        
        for ($month = 1; $month <= 12; $month++){
            print ("$month");
        }
        
        for ($year = 0; $year <= 9999; $year++){
            print ("$year");
        }
        
        print (" You have choose to have an appointment on $hour:$minute:$second, $day/$month/$year <br></br>");
        print ("More information");
        
        if ($hour <= 12){
            print ("In 12 hours, the time and date is $hour:$minute:$second AM, $day/$month/$year");
        }else{
            $hour = $hour - 12;
            print ("In 12 hours, the time and date is $hour:$minute:$second PM, $day/$month/$year");
        }
        
        if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
            $count = 31;
        }
        else if ($month == 4 || $month == 6 || $month == 9 || $month == 11){
            $count = 30;
        }
        else if ($month == 2){
            if ($year % 4 == 0){
                if ($year % 100 == 0){
                    if($year % 400 == 0){
                        $count = 29;
                    }else{ $count = 28;}
                } else {
                    $count = 29;
                }
            }else{ $count = 28;}
        }
        print ("This month has $count days!");
        ?>
    </body>
</html>