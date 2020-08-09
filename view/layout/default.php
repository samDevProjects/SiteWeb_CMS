
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title_for_layout)?$title_for_layout:'My CMS website';?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <h3><a class="navbar-brand" href="#">My CMS Webstie</a></h3>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <?php foreach ($pages as $p): ?>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo BASE_URL.'/pages/view/'.$p->id; ?>" title="<?php echo $p->name; ?>"><?php echo $p->name; ?></a>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>
    </nav>

    <div class="container">
        <?php echo $content_for_layout; ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
