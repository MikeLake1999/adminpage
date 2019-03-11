<?php
class Admin
{
   private $conn;
   function __construct()
   {
      $servername = "localhost";
      $dbname = "edm";
      $username = "root";
      $password = "root";
      $port = "8889";


 // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname, $port);
    // Check connection
      if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
      } else {
         $this->conn = $conn;
      }

   }

   public function admin_list()
   {

      $sql = "SELECT AdminID, NameAdmin, AdminName, AdminPassword, Phone, Active, DATE_FORMAT(datetime,'%M %d, %Y') AS regdate from admin ORDER BY Datetime DESC";
      $result = $this->conn->query($sql);
      return $result;
   }

   public function admin_number()
   {
      $sql = "SELECT COUNT(*) AS number FROM admin";
      $result = $this->conn->query($sql);
      return $result;
   }

   public function create_admin_info($post_data = array())
   {

      if (isset($post_data['create_admin'])) {
         $admin_ID = mysqli_real_escape_string($this->conn, trim($post_data['admin_ID']));
         $admin_Name = mysqli_real_escape_string($this->conn, trim($post_data['admin_Name']));
         $name_Admin = mysqli_real_escape_string($this->conn, trim($post_data['name_Admin']));
         $admin_Password = mysqli_real_escape_string($this->conn, trim($post_data['admin_Password']));
         $phone = mysqli_real_escape_string($this->conn, trim($post_data['phone']));
         $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));

         $sql = "INSERT INTO admin (AdminID, NameAdmin, AdminName, AdminPassword, Phone, Active) VALUES ('$admin_ID', '$admin_Name', '$name_Admin','$admin_Password','$phone', '$active')";

         $result = $this->conn->query($sql);

         if ($result) {

            $_SESSION['message'] = "Successfully Created Admin Info";

         }
         unset($post_data['create_admin']);
      }


   }

   public function view_admin_by_admin_id($id)
   {
      if (isset($id)) {
         $admin_ID = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "SELECT AdminID, NameAdmin, AdminName, AdminPassword, Phone, Active, DATE_FORMAT(datetime,'%M %d, %Y') AS regdate from admin  where AdminID='$admin_ID' ORDER BY datetime DESC";

         $result = $this->conn->query($sql);

         return $result->fetch_assoc();

      }
   }


   public function update_admin_info($post_data = array())
   {
      if (isset($post_data['update_admin']) && isset($post_data['id'])) {

         $admin_Name = mysqli_real_escape_string($this->conn, trim($post_data['admin_Name']));
         $name_Admin = mysqli_real_escape_string($this->conn, trim($post_data['name_Admin']));
         $admin_Password = mysqli_real_escape_string($this->conn, trim($post_data['admin_Password']));
         $phone = mysqli_real_escape_string($this->conn, trim($post_data['phone']));
         $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));
         $admin_ID = mysqli_real_escape_string($this->conn, trim($post_data['id']));

         $sql = "UPDATE admin SET NameAdmin='$name_Admin', AdminName='$admin_Name', AdminPassword='$admin_Password', Phone='$phone', Active='$active' WHERE AdminID = $admin_ID";

         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Updated Admin Info";
         }
         unset($post_data['update_admin']);
      }
   }

   public function delete_admin_info_by_id($id)
   {

      if (isset($id)) {
         $admin_id = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "DELETE FROM  admin  WHERE AdminID =$admin_id";
         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Deleted Admin Info";

         }
      }
    
   }
   function __destruct()
   {
      mysqli_close($this->conn);
   }

}

?>