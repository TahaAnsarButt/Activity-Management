<?php
defined('BASEPATH') or exit('No direct script access allowed');


class lcd extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('ClassModel', 'CT');
		$this->load->database();
	}

	public function index()
	{
			$this->load->view("LCD/WeeklyGraph");
		
	}



	

	public function getPrayersDataweekly()
	{
		// Call the PrayerReport3test method to get the data
		$this->load->helper('array');
		$data['BarDatalastWeek'] = $this->PrayerReportweekly();
		// $data['BarDatabottomlastWeek'] = $this->PrayerReportweeklydrilldown(); // Assuming the same data structure for both

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	


// public function PrayerReportweekly()
// {

// 	$month = date('m');
// 	$year = date('Y');
// 	$startweek = date('d')-6;
// 	$today = date('d') -1;

// $previousmonthday2 = date('t', strtotime('-1 month'));
// $newday2 = $previousmonthday2;

// 	$newmonth = $month-1;
// $previousmonthday = date('t', strtotime('-1 month'));
// $newday = $previousmonthday -6;

// if($today <= 0)
// {
// 	$today = $newday2;
// }

// if($startweek <= 0)
// {
// 	$month--;
// 	if ($month == 0)
// 	{
// 	$month = 12;
// 	}
// 	$startweek = $newday;

// }
// // print_r($startweek);
// // '\n';
// // print_r($month);
// // die;


// 	// print_r($_POST);
// 	// die;
// 	// Define the month and year parameters
// 	// $month = $this->input->post('month'); // Example month
// 	// $year = $this->input->post('year'); // Example year

// 	// $month = 3; 
// 	// $year = 2024; 

// 	// Call the stored procedure with parameters
// 	$query = $this->db->query('EXEC Namaz_counter_Dept_Perc ?, ?', array($month, $year));

// 	// Check if the stored procedure call was successful
// 	if ($query) {
// 		// Fetch the result
// 		$data['storedata'] = $query->result_array();
// 		// print_r($data['storedata']);die;
// 		// Generate the dates array based on the given month and year


// 		// Calculate cumulative sum for each row
// 		// foreach ($data['storedata'] as &$item) {

// 		// 	$cumulativeSum = 0;
// 		// 	$countofentries = 0;
// 		// 	// foreach ($item as $key) {

// 		// 	// }
// 		// 	foreach ($item as $key => $value) {

// 		// 		foreach ($value as $news){
// 		// 		print_r($news);
// 		// 		}
				
				
// 		// 			if($key >= $startweek && $key <= $today)
// 		// 			{
// 		// 				$cumulativeSum = $cumulativeSum + $value;
// 		// 			$countofentries++;
// 		// 			// print_r($key);
// 		// 			// print_r($value);
// 		// 			// print_r($countofentries);
// 		// 			}

					
					
				
				
				
// 		// 	}
			
// 		// 	// Add the total cumulative sum to the last column
					
// 		// 	$item['ClassPercentage'] = $countofentries > 0 ?  round($cumulativeSum / $countofentries) : 0;


// 		// 	// print_r($item['Total']);

// 		// }

// 		foreach ($data['storedata'] as &$item) {
// 			$cumulativeSum = 0;
// 			$countofentries = 0;
			
// 			// Loop through each day from 25 to 31
// 			for ($days = $startweek; $days <= $today; $days++) {
// 				// Check if the key exists and is numeric
// 				if (isset($item[$days]) ) {
// 					// Add the numeric value to cumulativeSum and increment countofentries
// 					$cumulativeSum += $item[$days];
// 					$countofentries++;
// 				}
// 			}
		
// 			// Calculate ClassPercentage
// 			$item['ClassPercentage'] = $countofentries > 0 ? round($cumulativeSum / $countofentries) : 0;
// 		}

// 		return $data['storedata'];

// 	} else {
// 		// Handle error
// 		echo "Error executing stored procedure.";
// 		return false;
// 	}
	
// }

// public function PrayerReportweekly()
// 	{
//         $today = date('d');
//         $month = date('m');
//         $year = date('Y');
        
//         // Create a DateTime object for today's date
//         $date = new DateTime("$year-$month-$today");
        
//         // Get the ISO-8601 numeric representation of the day of the week (1 for Monday, 7 for Sunday)
//         $weekday = $date->format('N');
        
//         // Calculate the start day of the week (Monday)
//         $startday = $date->modify('-' . ($weekday - 1) . ' days')->format('d');
        
//         // Calculate the end day of the week (Sunday)
//         $endday = $date->modify('+' . (7 - $weekday) . ' days')->format('d');
//         // echo "week day: " . $weekday . "<br>";
//         // echo "Start day: " . $startday . "<br>";
//         // echo "End day: " . $endday;
        
//         // die;
		
		
// 		// print_r($_POST);
// 		// die;
// 		// Define the month and year parameters
// 		// $month = $this->input->post('month'); // Example month
// 		// $year = $this->input->post('year'); // Example year

// 		// $month = 3; 
// 		// $year = 2024; 

// 		// Call the stored procedure with parameters
// 		$query = $this->db->query('EXEC Namaz_counter_Dept_Perc ?, ?', array($month, $year));

// 		// Check if the stored procedure call was successful
// 		if ($query) {
// 			// Fetch the result
// 			$data['storedata'] = $query->result_array();
// 			// print_r($data['storedata']);die;
// 			// Generate the dates array based on the given month and year


// 			// Calculate cumulative sum for each row
// 			foreach ($data['storedata'] as &$item) {
// 				$cumulativeSum = 0;
// 				$countofentries = 0;
// 				foreach ($item as $key => $value) {
// 					if (!in_array($key, ['DeptName', 'CardNo', 'Name']) && $key >= $startday && $key <= $endday) {
// 						// print_r($value);
// 						$cumulativeSum = $cumulativeSum + $value;
// 						$countofentries++;
// 					}
// 				}
// 				// Add the total cumulative sum to the last column
// 				$item['ClassPercentage'] = round($cumulativeSum / $countofentries);


// 				// print_r($item['Total']);

// 			}
// 			return $data['storedata'];

// 		} else {
// 			// Handle error
// 			echo "Error executing stored procedure.";
// 			return false;
// 		}
		
// 	}

public function PrayerReportweekly()
	{
		$today = date('d');
		$month = date('m');
		$year = date('Y');

		// Create a DateTime object for today's date
		$date = new DateTime("$year-$month-$today");
		$week = date("W");

		// Get the ISO-8601 numeric representation of the day of the week (1 for Monday, 7 for Sunday)
		$weekday = $date->format('N');

		// Calculate the start day of the week (Monday)
		$dto = new DateTime();
		$dto->setISODate($year, $week);
		$startday = $dto->format('d');
		$dto->modify('+6 days');
		$endday = $dto->format('d');

		// Check if the week falls between two months
		$startMonth = $dto->format('m');
		$dto->modify('-6 days');
		$endMonth = $dto->format('m');

// 		echo "Start Day: " . $startday . "<br>";
// echo "End Day: " . $endday . "<br>";
// echo "Start Month: " . $startMonth . "<br>";
// echo "End Month: " . $endMonth . "<br>";

		$data = array();

		// Execute stored procedure for the start month
		// Execute stored procedure for the start month
		$queryStartMonth = $this->db->query('EXEC Namaz_counter_Dept_Perc_week ?, ?', array($week, $year));
		if ($queryStartMonth) {
			$data['storedata'] = $queryStartMonth->result_array();

			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;
				foreach ($item as $key => $value) {
					// Check if the key is a numeric day value and falls within the current week
					if (is_numeric($key)) {
						$cumulativeSum += $value;
						$countofentries++;
					}
				}
				// Calculate the average and update the 'ClassPercentage'
				if ($countofentries > 0) {
					$item['ClassPercentage'] = round($cumulativeSum / $countofentries, 2); // Round to 2 decimal places
				} else {
					$item['ClassPercentage'] = 0; // If no entries, set the percentage to 0
				}
			}
		} else {
			echo "Error executing stored procedure for the start month.";
			return false;
		}



		return $data['storedata'];
	}



// public function PrayerReportweeklydrilldown()
// {
// 	// Define the month and year parameters
// 	// $month = $this->input->post('month'); // Example month
// 	// $year = $this->input->post('year'); // Example year
// 	$month = date('m');
// 	$year = date('Y');
// 	$startweek = date('d')-6;
// 	$today = date('d') -1;

// 	$previousmonthday2 = date('t', strtotime('-1 month'));
// 	$newday2 = $previousmonthday2;

// 		$newmonth = $month-1;
// 	$previousmonthday = date('t', strtotime('-1 month'));
// 	$newday = $previousmonthday -6;
	
// 	if($today <= 0)
// 	{
// 		$today = $newday2;
// 	}

// 	if($startweek <= 0)
// 	{
// 		$month--;
// 		if ($month == 0)
// 		{
// 		$month = 12;
// 		}
// 		$startweek = $newday;

// 	}

// 	// $month = 3; 
// 	// $year = 2024; 
// 	// Call the stored procedure with parameters
// 	$query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc ?, ?', array($month, $year));

// 	// Check if the stored procedure call was successful
// 	if ($query) {
// 		// Fetch the result
// 		$data['storedata'] = $query->result_array();

// 		// Calculate cumulative sum for each row and divide by the count of non-empty values
// 		foreach ($data['storedata'] as &$item) {
// 			$cumulativeSum = 0;
// 			$countofentries = 0;

// 			// foreach ($item as $key => $value) {
// 			// 	if (!in_array($key, ['DeptName', 'Class']) && $key >= $startweek && $key <= $today) {
					
// 			// 		$cumulativeSum += $value;
// 			// 		$countofentries++;
// 			// 	}
					
// 			// }
// 			for ($days = $startweek; $days <= $today; $days++) {
// 				// Check if the key exists and is numeric
// 				if (isset($item[$days]) ) {
// 					// Add the numeric value to cumulativeSum and increment countofentries
// 					$cumulativeSum += $item[$days];
// 					$countofentries++;
// 				}
// 			}

// 			// Add the total cumulative sum to the last column
// 			$item['ClassPercentage'] = $countofentries > 0 ?   round($cumulativeSum / $countofentries) : 0;
// 		}

// 		return $data['storedata'];
// 	} else {
// 		// Handle error
// 		echo "Error executing stored procedure.";
// 		return false;
// 	}
// }


public function PrayerReportweeklydrilldown()
	{
		// Define the month and year parameters
		// $month = $this->input->post('month'); // Example month
		// $year = $this->input->post('year'); // Example year
		$month = date('m');
		$year = date('Y');
		$startweek = date('d')-7;
		$today = date('d');

		// $month = 3; 
		// $year = 2024; 
		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc ?, ?', array($month, $year));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();

			// Calculate cumulative sum for each row and divide by the count of non-empty values
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;

				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'Class']) && $key >= $startweek && $key <= $today) {
						$cumulativeSum += $value;
						$countofentries++;
					}
				}

				// Add the total cumulative sum to the last column
				$item['ClassPercentage'] = round($cumulativeSum / $countofentries);
			}

			return $data['storedata'];
		} else {
			// Handle error
			echo "Error executing stored procedure.";
			return false;
		}
	}

	



	
}
