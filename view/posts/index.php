<br>
<div class="page-header">
    <h1>The blog</h1>
</div>



<?php foreach ($posts as $key => $value): ?>
    <h2><?php echo $value->name;  ?></h2>
    <?php echo $value->content; ?>
    <p><a href="<?php echo BASE_URL.'/posts/view/'.$value->id; ?>">Read more &rarr;</a></p>
<?php endforeach; ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for ($i=1; $i <= $totalPages; $i++) : ?>
    <li class="page-item" <?php if($i==$this->request->page)echo 'class="active"';?>>
      <a class="page-link" href="?page=<?php echo $i; ?>"><?= $i ?></a>
    </li>
    <?php endfor; ?>
  </ul>
</nav>