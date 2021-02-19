<?php
$chain =array();
foreach ($cats->result() as $key => $value) {
  if($value->parent != ''){
    array_push($chain,$value->parent);
  }
}
$parents = array_unique($chain);
?>
<main>
  <div class="row" style="padding:30px;">
    <form class="col s4" action="<?=base_url('Welcome/publish')?>" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="cname" type="text" name="cname">
          <label for="cname">Name</label>
        </div>
        <div class="input-field col s12">
          <select name="parent">
            <option value="false" disabled selected>Choose your option</option>
            <?php foreach ($dropdown->result() as $key => $value): ?>
              <option value="<?=$value->CID?>"><?=$value->cname?></option>
            <?php endforeach; ?>
          </select>
          <label>Parent</label>
        </div>
        <div class="input-field col s12">
          <input id="cdesc" type="text" name="desc">
          <label for="cdesc">Description</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" name="button" class="waves-effect waves-light btn">Submit</button>
          <input type="text" name="action" value="category" hidden>
        </div>
      </div>
    </form>
    <div class="col s8">
      <table id="table_id" class="highlight">
          <thead>
              <tr>
                  <th style="width:25px;"><label> <input type="checkbox" class="filled-in" /> <span></span> </label></th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Edit</th>
              </tr>
          </thead>
          <tbody>

            <?php foreach ($parents as $key => $value): ?>
              <?php $this->db->where('parent',$value); ?>
              <?php $data = $this->db->get('categories'); ?>
              <?php $this->db->where('CID',$value); ?>
              <?php $main = $this->db->get('categories')->result(); ?>
              <?php $EditID = $main[0]->CID?>
              <?php $ViewSlug = $main[0]->cslug?>
              <tr>
                  <th><label> <input type="checkbox" class="filled-in" /> <span></span> </label></th>
                  <td><?=$main[0]->cname?></td>
                  <td><?=$main[0]->cslug?></td>
                  <td>
                    <a href="<?=base_url('admin-panel/edit?action=category&task=edit&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light orange btn-small"><i class="material-icons">edit</i></a>
                    <a href="<?=base_url('admin-panel/edit?action=category&task=delete&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
                    <a target="_blank" href="<?=base_url('c/'.$ViewSlug)?>" class="btn-floating btn-large waves-effect waves-light  cyan darken-4 btn-small"><i class="material-icons">open_in_new</i></a>
                  </td>
              </tr>
              <?php foreach ($data->result() as $keye => $child): ?>
                <?php $EditID = $child->CID?>
                <?php $ViewSlug = $child->cslug?>
                <tr>
                    <th><label> <input type="checkbox" class="filled-in" /> <span></span> </label></th>
                    <td> <i class="material-icons" style="font-size:16px;position:relative;top:3px;">subdirectory_arrow_right</i> <?=$child->cname?></td>
                    <td><?=$child->cslug?></td>
                    <td>
                      <a href="<?=base_url('admin-panel/edit?action=category&task=edit&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light orange btn-small"><i class="material-icons">edit</i></a>
                      <a href="<?=base_url('admin-panel/edit?action=category&task=delete&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
                      <a target="_blank" href="<?=base_url('c/'.$ViewSlug)?>" class="btn-floating btn-large waves-effect waves-light  cyan darken-4 btn-small"><i class="material-icons">open_in_new</i></a>
                    </td>
                </tr>
              <?php endforeach; ?>
            <?php endforeach; ?>
              <?php foreach ($singlec->result() as $key => $value): ?>
                <?php if ($value->parent == ''): ?>
                  <?php $EditID = $value->CID?>
                  <?php $ViewSlug = $value->cslug?>
                  <tr>
                      <th><label> <input type="checkbox" class="filled-in" /> <span></span> </label></th>
                      <td><?=$value->cname?></td>
                      <td><?=$value->cslug?></td>
                      <td>
                        <a href="<?=base_url('admin-panel/edit?action=category&task=edit&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light orange btn-small"><i class="material-icons">edit</i></a>
                        <a href="<?=base_url('admin-panel/edit?action=category&task=delete&id='.$EditID)?>" class="btn-floating btn-large waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
                        <a target="_blank" href="<?=base_url('c/'.$ViewSlug)?>" class="btn-floating btn-large waves-effect waves-light  cyan darken-4 btn-small"><i class="material-icons">open_in_new</i></a>
                      </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
          </tbody>
      </table>
  </div>
</main>
