<main>
  <div style="padding:20px">
    <table id="table_id" class="striped" border="0">
        <thead>
            <tr>
                <th style="width:25px;"><label> <input id="checkall" type="checkbox" class="filled-in" /> <span></span> </label></th>
                <th style="width:150px">image</th>
                <th style="width:150px">Name</th>
                <th style="width:100px;">Slug</th>
                <th style="width:50px">Edit</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($posts->result() as $key => $post): ?>
            <tr>
              <td><label> <input value="<?=$post->ID?>" id="paction" type="checkbox" /> <span></span> </label></td>
              <td style="max-width:50px;"> <img class="materialboxed" src="../<?=$post->image_path?>" height="50"> </td>
              <td><?=$post->title?></td>
              <td style="max-width:100px;overflow:hidden"> <a target="_blank" href="<?=base_url('freepng/'.$post->slug)?>"><?=$post->slug?></a> </td>
              <td style="width:150px">
                <a href="<?=base_url('admin-panel/edit?action=post&task=edit&id='.$post->ID)?>" class="btn-floating btn-large waves-effect waves-light orange btn-small"><i class="material-icons">edit</i></a>
                <a id="dpost" href="" did="<?=$post->ID?>" class="btn-floating btn-large waves-effect waves-light red btn-small"><i class="material-icons">delete</i></a>
                <a target="_blank" href="<?=base_url('freepng/'.$post->slug)?>" class="btn-floating btn-large waves-effect waves-light  cyan darken-4 btn-small"><i class="material-icons">open_in_new</i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>
</main>
