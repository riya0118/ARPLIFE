<style>
    .ddgroup {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .dropdowncustom {
        position: relative;
        width: 125px;
        max-width: 150px;
        min-width: 120px;
        padding: 2px;
        border: 1px solid transparent;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        text-overflow: ellipsis;
    }

    .dropdowncustom:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .dropdowngroup {
        display: flex;
        flex-direction: column;
        width: 50%;
        justify-content: center;
    }

    .ddgroup {
        margin: 10px;
    }

    .cities,
    .countries,
    .states {
        background-color: snow;
        color: black;
        padding: 3px;
    }

    .dropdowncustom:hover {
        background-color: royalblue;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
<div class="modal fade" id="editprofileaddressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="recipient-name" class="col-form-label">FLAT/HOUSE/STREET:</label>
                        <input type="text" class="customtext" id="recipient-name" value="<?php echo $address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Pincode:</label>
                        <input type="text" class="customtext" id="recipient-name" value="<?php echo $pincode; ?>">
                    </div>
                    <div class="dropdowngroup">
                        <div class="ddgroup">
                            <label for="message-text" class="col-form-label">Country:</label>
                            <select name="countrydropdown" class="dropdowncustom btn-primary" id="countrydropdown">
                                <option class="countries" value="">Select Country</option>
                                <?php
                                $countryqry = "Select * from country_master";
                                $countryres = mysqli_query($conn, $countryqry);
                                while($countryrow = mysqli_fetch_array($countryres)){
                                    ?>
                                    <option class="countries" value="<?php echo $countryrow['cntry_countryid']; ?>"><?php echo $countryrow['cntry_countryname']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="ddgroup">
                            <label for="message-text" class="col-form-label">State:</label>
                            <select name="statedropdown" class="dropdowncustom btn-primary" id="statedropdown">
                                <option class="states" value="">Select State</option>
                                <?php
                                $stateqry = "Select * from state_master";
                                $stateres = mysqli_query($conn, $stateqry);
                                while($staterow = mysqli_fetch_array($stateres)){
                                    ?>
                                    <option class="states" value="<?php echo $staterow['sm_stateid']; ?>"><?php echo $staterow['sm_statename']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="ddgroup">
                            <label for="message-text" class="col-form-label">City:</label>
                            <select name="citydropdown" class="dropdowncustom btn-primary" id="citydropdown">
                                <option class="cities" value="">Select City</option>
                                <?php
                                $cityqry = "Select * from city_master";
                                $cityres = mysqli_query($conn, $cityqry);
                                while($cityrow = mysqli_fetch_array($cityres)){
                                    ?>
                                    <option class="cities" value="<?php echo $cityrow['cty_cityid']; ?>"><?php echo $cityrow['cty_cityname']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
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