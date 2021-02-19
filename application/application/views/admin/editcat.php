<?php 
$catw = $category->result()[0];

 ?>
<main>
  <div class="row" style="padding:30px;">
<?php if (isset($_GET['msg'])): ?>
  <blockquote>
    Category Upadated Successfully <a href="<?=base_url('admin-panel/add/category')?>">go back</a>
</blockquote>
<?php endif; ?>
    <form class="col s12" action="<?=base_url('Welcome/Edit')?>" method="GET">
      <div class="row">
        <div class="input-field col s12">
          <input id="cname" type="text" name="cname" value="<?=$catw->cname?>">
          <label for="cname">Name</label>
        </div>
        <div class="input-field col s12">
          <select name="parent" <?=($catw->srole == 1)?'disabled':''?>>
            <option value="false" disabled selected>Choose your option</option>
            <?php foreach ($dropdown->result() as $key => $value): ?>
              <?php if ($value->CID == $catw->parent): ?>
              <option value="<?=$value->CID?>" selected><?=$value->cname?></option>
              <?php endif; ?>
              <option value="<?=$value->CID?>"><?=$value->cname?></option>
            <?php endforeach; ?>
          </select>
          <label>Parent</label>
        </div>
        <div class="input-field col s12">
          <input id="cdesc" type="text" name="desc" value="<?=$catw->desce?>">
          <label for="cdesc">Description</label>
        </div>   
        <div class="input-field col s12">
          <button type="submit" name="button" class="waves-effect waves-light btn">Submit</button>
          <input type="text" name="action" value="category" hidden>
          <input type="text" name="task" value="update" hidden>
          <input type="text" name="id" value="<?=$catw->CID?>" hidden>
        </div>       
      </div>
    </form>
      
  </div>
</main>















