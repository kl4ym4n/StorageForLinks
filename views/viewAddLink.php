<?php
class ViewAddLink extends View
{
    public function __construct()
    {
        $this->template = '<div class="container">
                            <form class= "form-horizontal" method = post action="AddLink">

                            <fieldset>

                            <legend>Add new link</legend>

                            <div class="control-group">
                                <label class="control-label">Link title</label>
                                    <div class="controls">
                                    <input type="text" name = "linkheader" value ="" required autofocus>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link</label>
                                    <div class="controls">
                                    <input type="text" name = "userlink" value ="" required>
                                    </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Description</label>
                                    <div class="controls">
                                    <textarea class="form-control" rows="5" name="linkdescription"></textarea>
                                    </div>
                            </div>

                            <div class="checkbox">
                                <input type="hidden" name="linkflag" value="0" />
                                <label><input type="checkbox" name = "linkflag" value = "1">Set private</label>
                            </div>

                            <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                            <button type="submit" class="btn btn-primary" name = "addlinkbutton">Add Link</button>
                            </div>
                            </div>

                            </fieldset>
                            </form>';
    }
}



