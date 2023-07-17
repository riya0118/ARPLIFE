<div class="modal fade" id="editprofilemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- action="../admin/functions/profilechanged.php" -->
                <form method="POST" id="myform" action="../admin/functions/profilechanged.php" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="profile_image" class="col-form-label">Change Profile Pic:</label>
                        <div class="form-group">
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adminname" class="col-form-label">Change Admin Name:</label>
                        <input type="text" name="adminname" id="adminname" class="customtext" placeholder="Your Name" value="<?= $name; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="modal1_savebtn" >Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
