<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/adminModel.php';
class AdminModelTest extends TestCase
{
    //get user details
    public function testUserDetails()
    {
        // Arrange
        $type = "doctor"; // Replace with usertype.
        //if you want to get doctor details then change type as patient.
        $id = 1; // Replace with the user ID you want to test
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");

        // Act
        $result = adminModel::userDetails($type, $id, $connection);

        // Assert
        $this->assertInstanceOf(mysqli_result::class, $result);
        $this->assertGreaterThan(0, mysqli_num_rows($result));
    }

    //hanlde doctor registration request
    public function testConfirmOrDenyDoctorRegistration()
    {

        // Arrange
        $request_id = 1; // Replace with the actual request ID you want to test
        $accept = 1; // Replace with the desired value for acceptance
        //if you want accept then set 1 and reject set 2
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");

        // Act 
        $result = adminModel::confirmOrDenyDoctorRegistration($request_id, $accept, $connection);

        // Assert
        $this->assertTrue($result);
    }
}
?>