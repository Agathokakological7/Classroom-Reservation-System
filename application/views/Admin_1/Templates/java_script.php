<!-- plugins:js -->
  <!-- endinject -->
  <script src="<?php echo base_url();?>/vendors/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url();?>/vendors/datatables.net/jquery.dataTables.js"></script>


  <script src="<?php echo base_url();?>/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url();?>/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url();?>/js/template.js"></script>
  <script src="<?php echo base_url();?>/js/settings.js"></script>
  <script src="<?php echo base_url();?>/js/todolist.js"></script>


  
  <script src="<?php echo base_url();?>/js/dashboard.js"></script>
  <script src="<?php echo base_url();?>/js/js/Chart.roundedBarCharts.js"></script>
 <!-- JavaScript Bundle with Popper -->

 


  <script> 
      function text(){
       var ab = document.getElementById("sysRadio1");
       var na = document.getElementById("sri");
       if(ab.selected == true  ){
        na.style.display="block";
       }else if(ab.checked == true){
        na.style.display="block";
       }else{
        na.style.display="none"
       }
      }

      function select_speaker(){
        
       var speaker = document.getElementById("speaker");
       var no_of_speaker = document.getElementById("no_of_speaker");
       if(speaker.checked == true){
        no_of_speaker.style.display="block";
       }
       else{
        no_of_speaker.style.display="none"
       }
      }

      function change(){
        var event_box = document.getElementById("event_id").value;
        var new_other = document.getElementById("new_other");
        if(event_box=='Others'){
          new_other.style.display="block";
        }
        else{
          new_other.style.display="none";
        }
      }

      function faculty_or_student(){
        var student = document.getElementById("Student");
        var faculty = document.getElementById("Faculty");
        if(student.checked == true){
          student_user.style.display="block";
          faculty_user.style.display="none";
       }
       else if (faculty.checked == true){
        student_user.style.display="none";
        faculty_user.style.display="block";
       }
      }

      $(document).ready(function () {
      $('#myTable').DataTable();
      });
      $(document).ready(function () {
          $('#available_search').DataTable();
      });
      $(document).ready(function () {
          $('#alloted_search').DataTable();
      });
      $(document).ready(function () {
          $('#recent_added').DataTable();
      });
      $(document).ready(function () {
          $('#class_rm_schedule').DataTable();
      });
  </script>

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="venuebooking"
  agent-id="06bcbe9e-9cea-42c9-be73-7622e9e33d30"
  language-code="en"
></df-messenger>
</body>

</html>

