<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Classes extends CI_Controller
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
			$this->load->view("Class/Dashboard");
		
	}

	public function EnterClass()
	{
		$this->load->view("Class/EnterClass");
	}

	public function Dashboard()
	{
		$this->load->view("Class/Dashboard");
	}




	public function getPrayersDatamonthly()
	{
		// Call the PrayerReport3test method to get the data
		$this->load->helper('array');
		$data['BarDatalastMonth'] = $this->PrayerReportmonthly();
		$data['BarDatabottomlastMonth'] = $this->PrayerReportmonthlydrilldown(); // Assuming the same data structure for both

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getPrayersDatadaily()
	{
		// Call the PrayerReport3test method to get the data
		$this->load->helper('array');
		$data['BarData'] = $this->PrayerReportdaily();
		$data['BarDatabottom'] = $this->PrayerReportdailydrilldown(); // Assuming the same data structure for both

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getPrayersDataweekly()
	{
		// Call the PrayerReport3test method to get the data
		$this->load->helper('array');
		$data['BarDatalastWeek'] = $this->PrayerReportweekly();
		$data['BarDatabottomlastWeek'] = $this->PrayerReportweeklydrilldown(); // Assuming the same data structure for both

		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getPrayersDatayearly()
	{
		// Call the PrayerReport3test method to get the data
		// $this->load->helper('array');
		// $data['BarDatalastYear'] = $this->PrayerReportyearly();
		// $data['BarDatabottomlastYear'] = $this->PrayerReportyearlydrilldown(); // Assuming the same data structure for both

		
		$data['BarDatalastYear'] = $this->CT->getPrayersDataYear();
		$data['BarDatabottomlastYear'] = $this->CT->getPrayersDatabottomYear();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function PrayerReportmonthlydrilldown()
	{
		// Define the month and year parameters
		// $month = $this->input->post('month'); // Example month
		// $year = $this->input->post('year'); // Example year
		$month = date('m');
		$year = date('Y');

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
					if (!in_array($key, ['DeptName', 'Class'])) {
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
	public function PrayerReportmonthly()
	{

		$month = date('m');
		$year = date('Y');
		// print_r($_POST);
		// die;
		// Define the month and year parameters
		// $month = $this->input->post('month'); // Example month
		// $year = $this->input->post('year'); // Example year

		// $month = 3; 
		// $year = 2024; 

		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Perc ?, ?', array($month, $year));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();
			// print_r($data['storedata']);die;
			// Generate the dates array based on the given month and year


			// Calculate cumulative sum for each row
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'CardNo', 'Name'])) {
						// print_r($value);
						$cumulativeSum = $cumulativeSum + $value;
						$countofentries++;
					}
				}
				// Add the total cumulative sum to the last column
				$item['ClassPercentage'] = round($cumulativeSum / $countofentries);


				// print_r($item['Total']);

			}
			return $data['storedata'];

		} else {
			// Handle error
			echo "Error executing stored procedure.";
			return false;
		}
		
	}

	public function PrayerReportdailydrilldown()
{
    $month = date('m');
    $year = date('Y');
    $day = date('d') - 1;
    // $month = 3;
    // $day = 31;


	if ($day == 0) {
        // Get the last day of the previous month
        $month = date('m', strtotime('-1 month'));
        $year = date('Y', strtotime('-1 month'));
        $day = date('t', strtotime('-1 month')); // Last day of the previous month
    }


    // Call the stored procedure with parameters
    $query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc ?, ?', array($month, $year));

    if ($query) {
        // Fetch the result
        $data['storedata'] = $query->result_array();

        // Calculate cumulative sum for each row and divide by the count of non-empty values
        foreach ($data['storedata'] as &$item) {
            $cumulativeSum = 0;
            $countofentries = 0;

            foreach ($item as $key => $value) {
                // Exclude 'DeptName' and 'Class' keys
                if (!in_array($key, ['DeptName', 'Class'])) {
                    // Check if the key matches today's day number
                    if ($key == $day && $value !== null) {
                        $cumulativeSum += $value;
                        $countofentries++;
                    }
                }
            }

            // Add the total cumulative sum to the last column
            if ($countofentries > 0) {
                $item['ClassPercentage'] = round($cumulativeSum / $countofentries);
            } else {
                $item['ClassPercentage'] = 0; // Set to 0 if no non-null entries found
            }
        }

        return $data['storedata'];
    } else {
        // Handle error
        echo "Error executing stored procedure.";
        return false;
    }
}

 
public function PrayerReportdaily()
{
    $month = date('m');
    $year = date('Y');
    $day = date('d') - 1;

    // If the calculated day is 0, it means we need data from the previous month
    if ($day == 0) {
        // Get the last day of the previous month
        $month = date('m', strtotime('-1 month'));
        $year = date('Y', strtotime('-1 month'));
        $day = date('t', strtotime('-1 month')); // Last day of the previous month
    }

    // Call the stored procedure with parameters
    $query = $this->db->query('EXEC Namaz_counter_Dept_Perc ?, ?', array($month, $year));

    if ($query) {
        // Fetch the result
        $data['storedata'] = $query->result_array();

        foreach ($data['storedata'] as &$item) {
            $lastentry = 0;
            foreach ($item as $key => $value) {
                if (!in_array($key, ['DeptName', 'CardNo', 'Name']) && $key == $day) {
                    // Update $lastentry with the current non-null value
                    $lastentry = $value;
                }
            }
            // Assign the last non-null value to the 'ClassPercentage' key
            $item['ClassPercentage'] = $lastentry;
        }
        return $data['storedata'];
    } else {
        // Handle error
        echo "Error executing stored procedure.";
        return false;
    }
}


public function PrayerReportweekly()
{
	$today = date('d')-6;
	$month = date('m');
	$year = date('Y');

	// Create a DateTime object for today's date
	$date = new DateTime("$year-$month-$today");
	$week = date("W")-1;

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

public function PrayerReportweeklydrilldown()
	{
		$today = date('d')-6;
		$month = date('m');
		$year = date('Y');

		// Create a DateTime object for today's date
		$date = new DateTime("$year-$month-$today");
		$week = date("W")-1;

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

		// echo "Start Day: " . $startday . "<br>";
		// echo "End Day: " . $endday . "<br>";
		// echo "Start Month: " . $startMonth . "<br>";
		// echo "End Month: " . $endMonth . "<br>";

		$data = array();

		// Execute stored procedure for the start month
		// Execute stored procedure for the start month
		$queryStartMonth = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc_week ?, ?', array($week, $year));
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

	public function PrayerReportyearlydrilldown()
	{
		// Define the month and year parameters
		// $month = $this->input->post('month'); // Example month
		// $year = $this->input->post('year'); // Example year
		$year1 = date('Y');

		// $month = 3; 
		// $year = 2024; 
		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc_Year ?', array($year1));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();

			// Calculate cumulative sum for each row and divide by the count of non-empty values
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;

				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'Class'])) {
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
	public function PrayerReportyearly()
	{

		$year1 = date('Y');
		// Define the month and year parameters
		// $month = $this->input->post('month'); // Example month
		// $year = $this->input->post('year'); // Example year

		// $month = 3; 
		// $year = 2024; 

		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Perc_YEar ?', array($year1));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();
			// print_r($data['storedata']);die;
			// Generate the dates array based on the given month and year


			// Calculate cumulative sum for each row
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'CardNo', 'Name'])) {
						// print_r($value);
						$cumulativeSum = $cumulativeSum + $value;
						$countofentries++;
					}
				}
				// Add the total cumulative sum to the last column
				$item['ClassPercentage'] = round($cumulativeSum / $countofentries);


				// print_r($item['Total']);

			}
			return $data['storedata'];

		} else {
			// Handle error
			echo "Error executing stored procedure.";
			return false;
		}
		
	}

public function getPrayersDatahistorically()
{
    // Extract start and end dates from POST data
    $startDate = $_POST['StartDate'];
    $endDate = $_POST['EndDate'];

    // Extract month and year components from start and end dates
    $startday = date('d', strtotime($startDate));

    $startMonth = date('m', strtotime($startDate));
    $startYear = date('Y', strtotime($startDate));

    $endday = date('d', strtotime($endDate));

    $endMonth = date('m', strtotime($endDate));
    $endYear = date('Y', strtotime($endDate));

    // Execute stored procedures to get historical prayer data
    $data['BarDatahistorical'] = $this->PrayerReporthistorically($startMonth, $startYear, $endMonth, $endYear , $startday , $endday);
    $data['BarDatabottomhistorical'] = $this->PrayerReporthistoricallydrilldown($startMonth, $startYear, $endMonth, $endYear,$startday ,$endday);

    // Return JSON response
    return $this->output
        ->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($data));
}

public function PrayerReporthistorically($month1, $year1, $month2, $year2 , $startday, $endday)
{
	

	
    // Call the stored procedure with parameters
    $query = $this->db->query('EXEC Namaz_counter_Dept_Perc_Histo ?, ?, ?, ?', array($month1, $year1, $month2, $year2));

    // Check if the stored procedure call was successful
    if ($query) {
        // Fetch the result
        $data['storedata'] = $query->result_array();

        // Calculate cumulative sum for each row and divide by the count of non-empty values
        foreach ($data['storedata'] as &$item) {
            $cumulativeSum = 0;
            $countofentries = 0;
            foreach ($item as $key => $value) {
                if (!in_array($key, ['DeptName', 'Day']) && $key >= $startday && $key <= $endday) {
                    $cumulativeSum += $value;
                    $countofentries++;
                }
            }

            // Add the total cumulative sum to the last column
            $item['ClassPercentage'] = $countofentries > 0 ? round($cumulativeSum / $countofentries) : 0;
        }

        return $data['storedata'];
    } else {
        // Handle error
        echo "Error executing stored procedure.";
        return false;
    }
}

public function PrayerReporthistoricallydrilldown($month1, $year1, $month2, $year2, $startday, $endday)
{
    // Call the stored procedure with parameters
    $query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc_Histo ?, ?, ?, ?', array($month1, $year1, $month2, $year2));

    // Check if the stored procedure call was successful
    if ($query) {
        // Fetch the result
        $data['storedata'] = $query->result_array();

        // Calculate cumulative sum for each row and divide by the count of non-empty values
        foreach ($data['storedata'] as &$item) {
            $cumulativeSum = 0;
            $countofentries = 0;
            foreach ($item as $key => $value) {
                if (!in_array($key, ['DeptName', 'Class', 'Day']) && $key >= $startday && $key <= $endday) {
                    $cumulativeSum += $value;
                    $countofentries++;
                }
            }

            // Add the total cumulative sum to the last column
            $item['ClassPercentage'] = $countofentries > 0 ? round($cumulativeSum / $countofentries) : 0;
        }

        return $data['storedata'];
    } else {
        // Handle error
        echo "Error executing stored procedure.";
        return false;
    }
}








	public function insertDetail()
	{

		$Month = date('m');
		$Year = date('Y');
		$Day = date('d');
		$CurrentDate = $Year . '-' . $Month . '-' . $Day;

		$StaticCardNo = $_SESSION['CardNo'];

		$data = array(
			'Department' => $this->input->post('Department'),
			'Class' => $this->input->post('Class'),
			'CardNO' => $this->input->post('Card1'),
			'CardNO2' => $this->input->post('Card2'),
			'EntryDate' => $CurrentDate,
			'HeadCardNo' => $StaticCardNo,
			'HeadStatus' => 1
		);

		$this->CT->insertDetail($data);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function deleteFGT()
	{
		$data = $this->CT->deleteFGT($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getAllEntries()
	{

		$data = $this->CT->getAllEntries();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function EditRequest()
	{
		$data = $this->CT->EditRequest($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function updateRequest()
	{


		$data = array(
			'Class' => $this->input->post('Class'),
			'CardNO' => $this->input->post('Card1'),
			'CardNO2' => $this->input->post('Card2'),
		);

		$this->CT->updateRequest($data, $_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}



	public function SubordinatePage()
	{
		$this->load->view("Class/SubordinateNamaz");
	}

	public function getClass()
	{

		$data = $this->CT->getClass();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function GetDeptCardCount()
	{

		$data = $this->CT->GetDeptCardCount();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function insertClassDetail()
	{
		// print_r($_POST);
		// die;

		$Month = date('m');
		$Year = date('Y');
		$Day = date('d');
		$CurrentDate = $Year . '-' . $Month . '-' . $Day;

		$Deptid = $_SESSION['deptid'];
		// $HeadCardNo = $_SESSION['CardNo'];

		$data = array(
			'Department' => $Deptid,
			'Class' => $this->input->post('Class'),
			'ClassID' => $this->input->post('ClassID'),
			'CardNO' => $this->input->post('Card1'),
			'EntryDate' => $CurrentDate,
			'HeadCardNo' => $this->input->post('HeadCardNo'),
			'HeadCardNo2' => $this->input->post('HeadCardNo2'),
			'HeadClass' => $this->input->post('Class'),
			'ClassMemberName' => $this->input->post('name'),
			'Designation' => $this->input->post('designame'),
			'Status' => 1
		);

		$this->CT->insertClassDetail($data);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}



	public function getAllClassEntries()
	{

		$data = $this->CT->getAllClassEntries($_POST['Class']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getPrayerData()
	{

		$data = $this->CT->getPrayerData($_POST['Date'], $_POST['ClassID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getClassID()
	{

		$data = $this->CT->getClassID();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function getHeadCards()
	{

		$data = $this->CT->getHeadCards($_POST['Class']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function checkstatus()
	{
		$data = $this->CT->checkstatus($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}



	public function inactiveSubClass()
	{
		$data = $this->CT->inactiveSubClass($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function activeSubClass()
	{
		$data = $this->CT->activeSubClass($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function deleteSubClass()
	{
		$data = $this->CT->deleteSubClass($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function editSubClass()
	{
		$data = $this->CT->editSubClass($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function updateSubClass()
	{


		$data = array(
			'Class' => $this->input->post('Class'),
			'CardNO' => $this->input->post('Card1'),
			'HeadClass' => $this->input->post('Class')

		);

		$this->CT->updateSubClass($data, $_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function PrayerEntry()
	{
		$this->load->view("Class/PrayerEntryView");
	}

	public function ClassMemberCount()
	{
		$this->load->view("Class/ClassMemberCount");
	}

	public function ClassMemberCounts()
	{
		$data = $this->CT->ClassMemberCounts();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function insertPrayerDetail()
	{

		$data = $this->CT->insertPrayerDetail(
			$_POST['CardNo'],
			$_POST['Class'],
			$_POST['ClassID'],
			$_POST['Department'],
			$_POST['Designation'],
			$_POST['PrayerEntry'],
			$_POST['Date'],
			$_POST['ClassMemberName'],
			$_POST['ClassPrayerCount'],
			$_POST['DepartmentCardCount']
			

		);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function getPrayerCount()
	{

		// print_r($_POST);
		// die;
		$data = $this->CT->getPrayerCount($_POST['TID']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function editPrayerCount()
	{
		// print_r($_POST);
		// die;

		$data = $this->CT->editPrayerCount($_POST['TID'], $_POST['NoOfPrayers']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function getAllClass()
	{

		$data = $this->CT->getAllClass($_POST['CurrentClass']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function getCurrentHeadsClass()
	{
		$data = $this->CT->getCurrentHeadsClass();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function prayertest()
	{
		$this->load->view("Class/PrayerTest");
	}


	public function getcardbydept()
	{
		$data = $this->CT->getcardbydept();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}




	public function entryexist()
	{

		$data = $this->CT->entryexist($_POST['CurrentClass'], $_POST['Date']);
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}


	public function getAllDeptEntries()
	{

		$data = $this->CT->getAllDeptEntries();
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function PrayerReport()
	{

		$this->load->view('Class/PrayerReport');
	}

	public function PrayerReportAll()
	{

		$this->load->view('Class/PrayerReportAll');
	}


	public function PrayerReport2()
{
    // Define the month and year parameters
    $month = $this->input->post('month'); // Example month
    $year = $this->input->post('year'); // Example year
    $deptid = $_SESSION['deptid'];

    // Call the stored procedure with parameters
    $query = $this->db->query('EXEC Namaz_counter_Dept ?, ?, ?', array($month, $year, $deptid));

    // Check if the stored procedure call was successful
    if ($query) {
        // Fetch the result
        $data['storedata'] = $query->result_array();

        // Sort the keys in ascending order
        foreach ($data['storedata'] as &$item) {
            ksort($item);
        }

        // Generate the dates array based on the given month and year
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates = array();
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = sprintf('%04d-%02d-%02d', $year, $month, $i);
        }

        // Calculate cumulative sum for each row
        foreach ($data['storedata'] as &$item) {
            $cumulativeSum = 0;
            foreach ($item as $key => $value) {
                if (!in_array($key, ['DeptName', 'Class', 'CardNo', 'Name'])) {
                    $cumulativeSum = $cumulativeSum + $value;
                }
            }
            // Add the total cumulative sum to the last column
            $item['Total'] = $cumulativeSum;
        }

        $this->load->view('Class/DepartmentTable', array('storedata' => $data['storedata'], 'dates' => $dates));
    } else {
        // Handle error
        echo "Error executing stored procedure.";
    }
}



	public function PrayerReport1()
	{
		// print_r($_POST);
		// die;
		// Define the month and year parameters
		$month = $this->input->post('month'); // Example month
		$year = $this->input->post('year'); // Example year

		// $month = 2; 
		// $year = 2024; 

		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_Counter ?, ?', array($month, $year));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();
			// print_r($data['storedata']);die;
			// Generate the dates array based on the given month and year
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$dates = array();
			for ($i = 1; $i <= $daysInMonth; $i++) {
				$dates[] = sprintf('%04d-%02d-%02d', $year, $month, $i);
			}

			// Calculate cumulative sum for each row
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'Class', 'CardNo', 'Name'])) {
						// print_r($value);
						$cumulativeSum = $cumulativeSum + $value;
					}
				}
				// Add the total cumulative sum to the last column
				$item['Total'] = $cumulativeSum;
			}



			$this->load->view('Class/Testt', array('storedata' => $data['storedata'], 'dates' => $dates));
		} else {
			// Handle error
			echo "Error executing stored procedure.";
		}
	}

	public function PrayerReport3()
	{
		// Define the month and year parameters
		$month = $this->input->post('month'); // Example month
		$year = $this->input->post('year'); // Example year

		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Class_Perc ?, ?', array($month, $year));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();

			// Generate the dates array based on the given month and year
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$dates = array();
			for ($i = 1; $i <= $daysInMonth; $i++) {
				$dates[] = sprintf('%04d-%02d-%02d', $year, $month, $i);
			}

			// Calculate cumulative sum for each row and divide by the count of non-empty values
			foreach ($data['storedata'] as &$item) {
				$nonEmptyValueCount = 0;
				$cumulativeSum = 0;
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'Class'])) {
						$cumulativeSum += $value;
						$nonEmptyValueCount++;
					}
				}
				// Add the total cumulative sum to the last column
				$item['Total'] = $nonEmptyValueCount > 0 ? round($cumulativeSum / $nonEmptyValueCount, 2) . '%' : '-';

				// Adjust percentage calculation and display for each non-empty value
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'Class', 'Total'])) {
						$item[$key] = round($value, 2) . '%';
					}
				}
			}

			$this->load->view('Class/AllTable', array('storedata' => $data['storedata'], 'dates' => $dates));
		} else {
			// Handle error
			echo "Error executing stored procedure.";
		}
	}



	public function PrayerReport4()
	{
		// print_r($_POST);
		// die;
		// Define the month and year parameters
		$month = $this->input->post('month'); // Example month
		$year = $this->input->post('year'); // Example year

		// $month = 2; 
		// $year = 2024; 

		// Call the stored procedure with parameters
		$query = $this->db->query('EXEC Namaz_counter_Dept_Perc ?, ?', array($month, $year));

		// Check if the stored procedure call was successful
		if ($query) {
			// Fetch the result
			$data['storedata'] = $query->result_array();
			// print_r($data['storedata']);die;
			// Generate the dates array based on the given month and year
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$dates = array();
			for ($i = 1; $i <= $daysInMonth; $i++) {
				$dates[] = sprintf('%04d-%02d-%02d', $year, $month, $i);
			}

			$totalSum = 0;
			$totalCount = 0;

			// Calculate cumulative sum for each row
			foreach ($data['storedata'] as &$item) {
				$cumulativeSum = 0;
				$countofentries = 0;
				foreach ($item as $key => $value) {
					if (!in_array($key, ['DeptName', 'CardNo', 'Name'])) {
						// print_r($value);
						$cumulativeSum = $cumulativeSum + $value;
						$countofentries++;
					}
				}
				// Add the total cumulative sum to the last column
				$item['Total'] = $cumulativeSum / $countofentries;

				// print_r($item['Total']);

				$totalSum += $item['Total'];
				$totalCount++;
			}

			if ($totalCount != 0) {
				$averageTotalPrayerPercentage = $totalSum / $totalCount;
			} else {
				// Handle the case when $totalCount is zero
				// For example, set $averageTotalPrayerPercentage to a default value
				$averageTotalPrayerPercentage = 0;
			}

			// print_r($averageTotalPrayerPercentage);


			$this->load->view('Class/OverallFactoryTable', array('storedata' => $data['storedata'], 'dates' => $dates, 'averageTotalPrayerPercentage' => $averageTotalPrayerPercentage));
		} else {
			// Handle error
			echo "Error executing stored procedure.";
		}
	}

	public function Overalldept()
	{

		$this->load->view('Class/PrayerReportOverallDept');
	}
}
