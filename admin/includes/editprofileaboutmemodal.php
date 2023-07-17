<div class="modal fade" id="editprofileaboutmemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="customtext" id="message-text" value="<?php echo $description; ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Mobile:</label>
                        <input type="text" class="customtext" id="recipient-name" value="<?php echo $mobile; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="customtext" id="recipient-name" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date of Birth:</label>
                        <input type="text" class="customtext" id="mdate" value="<?php echo $dob; ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>