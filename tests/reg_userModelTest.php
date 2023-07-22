<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/registerUserModel.php';
class reg_userModelTest extends TestCase
{

    public function testUserLogin_failure()
    {
        // Arrange
        $email = "sample@gmail.com"; 
        $password = ""; // Replace with the desired doctor ID
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");
        // Act
        $result = registerUserModel::loging($email, $password, $connection);

         // Assert
         $this->assertInstanceOf(mysqli_result::class, $result);
         $this->assertLessThanOrEqual(0, mysqli_num_rows($result));
    }


    
 
}
?>