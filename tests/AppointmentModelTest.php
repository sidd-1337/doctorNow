<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/appointmentModel.php';
class AppointmentModelTest extends TestCase
{

    public function testGetCountOfAppointment()
    {
        // Arrange
        // Arrange
        $status = 1; // Replace with the desired status
        $doctor_id = 1; // Replace with the desired doctor ID
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");
        // Act
        $result = appointmentModel::getCountOfAppointment($status, $doctor_id, $connection);

        // Assert
        $this->assertNotEmpty($result);
    }

    public function tesGetSpecificAppointment()
    {
        // Arrange
        $appointment_id = 1; 
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");

        // Act
        $result = appointmentModel::getSpecificAppointment($appointment_id, $connection);

        // Assert
        $this->assertInstanceOf(mysqli_result::class, $result);
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

    public function testGetPatientAppointments()
    {
        // Arrange
        // Arrange
        $status = 1; // Replace with the desired status
        $patient_id = 1; // Replace with the desired doctor ID
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");
        // Act
        $result = appointmentModel::getPatientAppointments($status, $patient_id, $connection);

        // Assert
        $this->assertNotEmpty($result);
    }

    public function testUpdateSpecificAppointmentByDoctor_failureScenario()
    {

        // Arrange
        $appointment_id = 0; 
        $doctor_id=0;
        $status=1;
        $remark="fail";
        $choose_appointment_date=null;

        $accept = 1; // Replace with the desired value for acceptance
        //if you want accept then set 1 and reject set 2
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");

        // Act 
        $result = appointmentModel::updateSpecificAppointmentByDoctor($appointment_id, $doctor_id,$status,$remark,$choose_appointment_date, $connection);

        // Assert
        $this->assertTrue($result);
    }

    public function testDeletePatientAppointment_failureScenario()
    {

        // Arrange
        $appointment_id = 0; 
        $patient_id=0;
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");

        // Act 
        $result = appointmentModel::deletePatientAppointment($appointment_id, $patient_id, $connection);

        // Assert
        $this->assertTrue($result);
    }

    
 
}
?>