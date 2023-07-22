<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/searchModel.php';
class SearchModelTest extends TestCase
{

    public function testAlldoctors()
    {
        // Arrange
        $connection = mysqli_connect("localhost", "root", "", "damsmsdb");
        // Act
        $result = searchModel::Alldoctors( $connection);

         // Assert
         $this->assertNotEmpty($result);
    }
}
?>