<?php
class Post
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

   public function post_list()
   {

      $sql = "SELECT PostID, AdminName, CatalogName, NamePost, Brief , Img, Content, ViewNumber, PostHot, ActivePost, AuthorPost,  DATE_FORMAT(DatePost,'%M %d, %Y') AS regdate from posts ORDER BY DatePost DESC";
      $result = $this->conn->query($sql);
      return $result;
   }

   public function post_number()
   {
      $sql = "SELECT COUNT(*) AS number FROM posts";
      $result = $this->conn->query($sql);
      return $result;
   }

   public function create_post_info($post_data = array())
   {

      if (isset($post_data['create_post'])) {
         $PostID = mysqli_real_escape_string($this->conn, trim($post_data['PostID']));
         $AdminID = mysqli_real_escape_string($this->conn, trim($post_data['AdminID']));
         $CatalogName = mysqli_real_escape_string($this->conn, trim($post_data['CatalogName']));
         $NamePost = mysqli_real_escape_string($this->conn, trim($post_data['NamePost']));
         $Brief = mysqli_real_escape_string($this->conn, trim($post_data['Brief']));
         $Img = mysqli_real_escape_string($this->conn, trim($post_data['Img']));
         $Content = mysqli_real_escape_string($this->conn, trim($post_data['Content']));
         $ViewNumber = mysqli_real_escape_string($this->conn, trim($post_data['ViewNumber']));
         $PostHot = mysqli_real_escape_string($this->conn, trim($post_data['PostHot']));
         $AuthorPost = mysqli_real_escape_string($this->conn, trim($post_data['AuthorPost']));
         $ActivePost = mysqli_real_escape_string($this->conn, trim($post_data['ActivePost']));

         $sql = "INSERT INTO posts (PostID, AdminName, CatalogName, NamePost, Brief , Img, Content, ViewNumber, PostHot, AuthorPost, ActivePost) VALUES ('$PostID', '$AdminID', '$CatalogName','$NamePost','$Brief', '$Img', '$Content', '$ViewNumber', '$PostHot', '$AuthorPost', '$ActivePost')";

         $result = $this->conn->query($sql);

         if ($result) {

            $_SESSION['message'] = "Successfully Created Post Info";

         }
         unset($post_data['create_admin']);
      }


   }

   public function view_post_by_post_id($id)
   {
      if (isset($id)) {
         $post_id = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "SELECT PostID, AdminName, CatalogName, NamePost, Brief , Img, Content, ViewNumber, PostHot, ActivePost, AuthorPost,  DATE_FORMAT(DatePost,'%M %d, %Y') AS regdate from posts Where PostID='$post_id' ORDER BY DatePost DESC";

         $result = $this->conn->query($sql);

         return $result->fetch_assoc();

      }
   }


   public function update_post_info($post_data = array())
   {
      if (isset($post_data['update_post']) && isset($post_data['id'])) {

         $PostID = mysqli_real_escape_string($this->conn, trim($post_data['id']));
         $CatalogName = mysqli_real_escape_string($this->conn, trim($post_data['CatalogName']));
         $NamePost = mysqli_real_escape_string($this->conn, trim($post_data['NamePost']));
         $Brief = mysqli_real_escape_string($this->conn, trim($post_data['Brief']));
         $Img = mysqli_real_escape_string($this->conn, trim($post_data['Img']));
         $Content = mysqli_real_escape_string($this->conn, trim($post_data['Content']));
         $ViewNumber = mysqli_real_escape_string($this->conn, trim($post_data['ViewNumber']));
         $PostHot = mysqli_real_escape_string($this->conn, trim($post_data['PostHot']));
         $AuthorPost = mysqli_real_escape_string($this->conn, trim($post_data['AuthorPost']));
         $ActivePost = mysqli_real_escape_string($this->conn, trim($post_data['ActivePost']));

         $sql = "UPDATE posts SET CatalogName='$CatalogName',NamePost='$NamePost',Brief='$Brief', Img='$Img', Content='$Content', ViewNumber='$ViewNumber', PostHot='$PostHot', AuthorPost='$AuthorPost', ActivePost='$ActivePost' WHERE PostID = '$PostID'";

         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Updated Post Info";
         }
         unset($post_data['update_post']);
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