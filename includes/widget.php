<div class="well">
  <h4>Completed</h4>

  <form method="post" action="newPost.php">
    <label for="name">Select a course:</label>
    <select name="course" id="course">
      <option value="CST-105 Computer Programming I">CST-105 Computer Programming I</option>
      <option value="CST-120 Introduction to Web Development">CST-120 Introduction to Web Development</option>
      <option value="CST-120 Introduction to Web Development">CST-120 Introduction to Web Development</option>
      <option value="CST-239 Programming in Java II">CST-239 Programming in Java II</option>
      <option value="CST-239 Programming in Java II">CST-239 Programming in Java II</option>
      <option value="CST-239 Programming in Java II">CST-239 Programming in Java II</option>
      <option value="CST-239 Programming in Java II">CST-239 Programming in Java II</option>
      <option value="CST-239 Programming in Java II">CST-239 Programming in Java II</option>
    </select>
    <button type="submit">Submit</button>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['course'])) {
        $selectedName = $_POST['course'];
      } else {
      }
    }
    ?>

  </form>

  <p>Over all Great experience</p>
</div>

</div>