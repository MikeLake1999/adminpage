<?php
class Album
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
// Album Controler --------------------------------------------------------
   public function album_list()
   {

      $sql = "SELECT AlbumID, AlbumName, Singer, Active FROM album";
      $result = $this->conn->query($sql);
      return $result;
   }



   public function album_number()
   {
      $sql = "SELECT COUNT(*) AS number FROM album";
      $result = $this->conn->query($sql);
      return $result;
   }

   public function create_album_info($post_data = array())
   {

      if (isset($post_data['create_album'])) {
         $album_Name = mysqli_real_escape_string($this->conn, trim($post_data['album_Name']));
         $singer = mysqli_real_escape_string($this->conn, trim($post_data['singer']));
         $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));

         $sql = "INSERT INTO album (AlbumName, Singer, Active) VALUES ('$album_Name', '$singer', '$active')";

         $result = $this->conn->query($sql);

         if ($result) {

            $_SESSION['message'] = "Successfully Created Album Info";

         }
         unset($post_data['create_album']);
      }


   }

   public function view_album_by_album_id($id)
   {
      if (isset($id)) {
         $album_ID = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "SELECT AlbumID, AlbumName, Singer, Active from album  where AlbumID='$album_ID'";

         $result = $this->conn->query($sql);

         return $result->fetch_assoc();

      }
   }


   public function update_album_info($post_data = array())
   {
      if (isset($post_data['update_album']) && isset($post_data['id'])) {

        $album_ID = mysqli_real_escape_string($this->conn, trim($post_data['id']));
        $album_Name = mysqli_real_escape_string($this->conn, trim($post_data['album_Name']));
        $singer = mysqli_real_escape_string($this->conn, trim($post_data['singer']));
        $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));

         $sql = "UPDATE album SET AlbumName='$album_Name', Singer='$singer', Active='$active' WHERE AlbumID = $album_ID";

         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Updated Album Info";
         }
         unset($post_data['update_album']);
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
   


   // Music Controler----------------------------------------------------------------------------------------------

   public function music_list($id)
   {
      if (isset($id)) {
         $album_ID = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "SELECT MusicID, AlbumID, MusicName, Composer, Active FROM music  where AlbumID='$album_ID'";

         $result = $this->conn->query($sql);

         return $result;

      }
   }

   public function view_music_by_music_id($id)
   {
      if (isset($id)) {
         $music_ID = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "SELECT MusicID, AlbumID, MusicName, Composer, Active FROM music  where MusicID='$music_ID'";

         $result = $this->conn->query($sql);

         return $result->fetch_assoc();

      }
   }




   public function create_music_info($post_data = array())
   {

      if (isset($post_data['create_music'])) {
         $album_ID = mysqli_real_escape_string($this->conn, trim($post_data['album_ID']));
         $music_Name = mysqli_real_escape_string($this->conn, trim($post_data['music_Name']));
         $ulr_Music = mysqli_real_escape_string($this->conn, trim($post_data['ulr_Music']));
         $composer = mysqli_real_escape_string($this->conn, trim($post_data['composer']));
         $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));

         $sql = "INSERT INTO music (AlbumID, MusicName, Ulrmusic, Composer, Active) VALUES ('$album_ID', '$music_Name','$ulr_Music', '$composer', '$active')";

         $result = $this->conn->query($sql);

         if ($result) {

            $_SESSION['message'] = "Successfully Created Music Info";

         }
         unset($post_data['create_music']);
      }


   }

   public function update_music_info($post_data = array())
   {
      if (isset($post_data['update_music']) && isset($post_data['id'])) {
         $music_ID = mysqli_real_escape_string($this->conn, trim($post_data['id']));
         $music_Name = mysqli_real_escape_string($this->conn, trim($post_data['music_Name']));
         $composer = mysqli_real_escape_string($this->conn, trim($post_data['composer']));
         $active = mysqli_real_escape_string($this->conn, trim($post_data['active']));

         $sql = "UPDATE music SET MusicName = '$music_Name', Composer = '$composer', Active = '$active' WHERE music.MusicID = '$music_ID'";

         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Updated Music Info";
         }
         unset($post_data['update_music']);
      }
   }
   public function delete_music_info_by_id($id)
   {

      if (isset($id)) {
         $music_id = mysqli_real_escape_string($this->conn, trim($id));

         $sql = "DELETE FROM  music  WHERE MusicID = '$music_id'";
         $result = $this->conn->query($sql);

         if ($result) {
            $_SESSION['message'] = "Successfully Deleted Music Info";

         }
      }
    
   }
   function __destruct()
   {
      mysqli_close($this->conn);
   }

}

?>