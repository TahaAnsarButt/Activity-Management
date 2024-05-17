<?php
defined('BASEPATH') or exit('No direct script access allowed');
include("phpqrcode/qrlib.php");
class ClassModel extends CI_Model
{
	public function getAllEntries()
	{
		$CardNo = $_SESSION['CardNo'];
		$query = $this->db->query("SELECT * FROM dbo.View_NamazDBJoin where CardNo = $CardNo or CardNo2 = $CardNo or HeadCardNo = $CardNo")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}



	public function insertDetail($data)
	{
		// print_r($data);
		if ($data) {
			$this->db->insert('dbo.tbl_Namaz_Class', $data);
			$this->session->set_flashdata('info', 'Data insert Successfully');
			return true;
		} else {
			$this->session->set_flashdata('danger', 'Data insert failed');
			return false;
		}
	}

	public function deleteFGT($TID)
	{
		$query = $this->db->query("DELETE FROM dbo.tbl_Namaz_Class WHERE TID= $TID");
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function EditRequest($TID)
	{
		if ($TID !== null) {
			$this->db->where('TID', $TID);
			$query = $this->db->get('dbo.tbl_Namaz_Class');
			return $query->result_array();
		} else {
			return false;
		}
	}


	public function updateRequest($data, $TID)
	{
		if ($TID !== null) {
			$this->db->where('TID', $TID);
			$query = $this->db->update('dbo.tbl_Namaz_Class', $data);
		}

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}



	public function getClass()
	{
		$CardNo = $_SESSION['CardNo'];
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Class where CardNo = '$CardNo' or CardNo2 = '$CardNo'")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}


	public function insertClassDetail($data)
	{
		// print_r($data);
		// die;
		if ($data) {
			$this->db->insert('dbo.tbl_Namaz_Class_Member', $data);
			$this->session->set_flashdata('info', 'Data insert Successfully');
			return true;
		} else {
			$this->session->set_flashdata('danger', 'Data insert failed');
			return false;
		}
	}


	public function getAllClassEntries($Class)
	{
		$query = $this->db->query("SELECT * FROM dbo.view_Namaz where ClassID = $Class")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function getPrayerData($Date, $ClassID)
	{
		$dept = $_SESSION['deptid'];
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Counter where Date = '$Date' and ClassID = $ClassID and DepartmentID = $dept ORDER BY SubordinateCardNo")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}


	public function getClassID()
	{
		$CardNo = $_SESSION['CardNo'];
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Class_Member where HeadCardNo = '$CardNo' or HeadCardNo2 = '$CardNo'")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function getHeadCards($Class)
	{
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Class where TID = '$Class'")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}


	public function deleteSubClass($TID)
	{
		$query = $this->db->query("DELETE FROM dbo.tbl_Namaz_Class_Member WHERE TID= $TID");
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function checkstatus($TID)
	{
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Class_Member where TID = $TID")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function inactiveSubClass($TID)
	{
		if ($TID !== null) {
			$query = $this->db->query("UPDATE   dbo.tbl_Namaz_Class_Member 
				SET   Status = 0
				WHERE  TID=$TID");
		}

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function activeSubClass($TID)
	{
		if ($TID !== null) {
			$query = $this->db->query("UPDATE   dbo.tbl_Namaz_Class_Member 
				SET   Status = 1
				WHERE  TID=$TID");
		}

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function editSubClass($TID)
	{
		if ($TID !== null) {
			$this->db->where('TID', $TID);
			$query = $this->db->get('dbo.view_Namaz');
			return $query->result_array();
		} else {
			return false;
		}
	}


	public function updateSubClass($data, $TID)
	{
		if ($TID !== null) {
			$this->db->where('TID', $TID);
			$query = $this->db->update('dbo.tbl_Namaz_Class_Member', $data);
		}

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}


	public function GetDeptCardCount()
	{
		$DepartmentID = $_SESSION['deptid'];
	
		$query1 = $this->db->query("select deptWiseCount from dbo.View_deptCardCount where Department = $DepartmentID")->result_array();
		
		if ($query1) {
			return $query1;
		} else {
			return false;
		}
	}

	public function ClassMemberCounts()
	{
	
		$query1 = $this->db->query("SELECT  * from   View_Namaz_ClassMembersCountNew
		")->result_array();
		
		if ($query1) {
			return $query1;
		} else {
			return false;
		}
	}

	public function getPrayersDataYear()
	{
		$Year = Date('Y');
		
		$query = $this->db->query("SELECT        YearCount, DeptName, Counter, Counter / YearCount AS ClassPercentage, Year
		FROM            dbo.View_Namaz_Dept_Perc_Year2
		WHERE        (Year = '$Year')")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function getPrayersDatabottomYear()
	{
		$Year = Date('Y');

		$query = $this->db->query("SELECT        YearCount, DeptName, Counter, Class, Counter / YearCount AS ClassPercentage, Year
		FROM            dbo.View_Namaz_Dept_Class_Perc_Year
		WHERE        (Year = '$Year')")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	


	public function insertPrayerDetail($CardNo, $Class, $ClassID, $Department, $Designation, $PrayerEntry, $Date, $ClassMemberName, $ClassPrayerCount , $DepartmentCardCount)
	{
		$Day = date('d');
		$Month = date('m');
		$Year = date('Y');
		$CurrentDate = $Year . '-' . $Month . '-' . $Day;
		$count = count($PrayerEntry);
		$HeadCardNo = $_SESSION['CardNo'];
		$DepartmentID = $_SESSION['deptid'];
		$DepartmentName = $_SESSION['deptName'];

		$NoOfActiveMembers = count($CardNo);
	
		$success = true;
		// print_r($_POST);
		// die;
		for ($i = 0; $i < $count; $i++) {
			// Insert data only if PrayerEntry is not empty for the current entry
			if (!empty($PrayerEntry[$i])) {
				$query = $this->db->query("INSERT INTO dbo.tbl_Namaz_Counter 
					(SubordinateCardNo,HeadCardNo,DepartmentID, MemberClass,ClassID, DesignationName, NoOfPrayers, Date, EntryDate, ClassMemberName, DepartmentName, ClassPrayerCount, DeptMemberCount) 
					VALUES ($CardNo[$i], 
					$HeadCardNo,
					$DepartmentID,
					'$Class[$i]',
					'$ClassID',
					'$Designation[$i]',
					$PrayerEntry[$i], 
					'$Date', 
					'$CurrentDate', 
					'$ClassMemberName[$i]'
					,'$DepartmentName',
					 $ClassPrayerCount * 5,
					 $DepartmentCardCount)");
				
				// Check if insertion was successful
				if (!$query) {
					$success = false;
					break; // Stop further processing if insertion fails
				}
			}
		}
	
		if ($success) {
			return ['success' => true, 'message' => 'Data inserted successfully'];
		} else {
			return ['danger' => true, 'message' => 'Data not inserted successfully'];
		}
	}



	public function getAllClass($CurrentClass)
	{
		$dept = $_SESSION['deptid'];
		$query = $this->db->query("SELECT * FROM dbo.View_Namaz where ClassID = $CurrentClass and Department = $dept  and Status = 1 ORDER BY CardNo")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function entryexist($CurrentClass, $Date)
	{
		$query = $this->db->query("SELECT * FROM dbo.tbl_Namaz_Counter where ClassID = $CurrentClass and Date = '$Date'")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}



	public function getCurrentHeadsClass()
	{
		$HeadCardNo = $_SESSION['CardNo'];
		$query = $this->db->query("SELECT TID,Class FROM dbo.view_Namaz_ClassID where CardNo = $HeadCardNo or CardNo2 = $HeadCardNo
		
		")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}




	public function getcardbydept()
	{
		$WebHRMS = $this->load->database('WebHRMS', TRUE);
		$deptNo = $_SESSION['deptid'];
		$query = $WebHRMS->query("SELECT   * from     View_CardByDept where Department_id = $deptNo")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function getPrayerCount($TID)
	{
		// $WebHRMS = $this->load->database('WebHRMS', TRUE);
		// $deptNo = $_SESSION['deptid'];
		$query = $this->db->query("SELECT   * from     dbo.tbl_Namaz_Counter where TID = $TID")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}


	public function editPrayerCount($TID, $NoOfPrayers)
	{
		// print_r($_POST);
		// die;
		if ($TID !== null) {
			$query = $this->db->query("UPDATE   dbo.tbl_Namaz_Counter 
				SET   NoOfPrayers = $NoOfPrayers
				WHERE  TID=$TID");

			$this->session->set_flashdata('info', 'data updated successfully');
		}

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}




	public function getAllDeptEntries()
	{
		$query = $this->db->query("SELECT        DepartmentID, DepartmentName
		FROM            dbo.tbl_Namaz_Counter
		GROUP BY DepartmentID, DepartmentName")->result_array();
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}




}
