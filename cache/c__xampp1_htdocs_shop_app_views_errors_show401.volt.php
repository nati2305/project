<?= $this->getContent() ?>
<div class="jumbotron">
    <h1>Not authorized</h1>
    <p>You are not authorized to view this page</p>
    <p><?= $this->tag->linkTo(['customer', 'search', 'class' => 'btn btn-primary']) ?></p>
</div>