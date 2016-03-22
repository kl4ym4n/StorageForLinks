<?php
class ViewLinkInfo extends View
{
    public function __construct($data)
    {
        $popupConfirm = new ViewConfirmDelete();
        if ($data["flag"] == '0')
        {
            $checkedFlag = 'Public';
        }
        else
        {
            $checkedFlag = 'Private';
        }
        //echo $data["flag"];
        $this->template = '<div class="container">

                            <fieldset>

                            <legend>View link info</legend>

                            <div class="control-group">
                                <label class="control-label">Link title:</label>
                                    <span class="inline">'.$data['header'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link:</label>
                                    <span class="inline">'.$data['link'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Description:</label>
                                    <span class="inline">'.$data['description'].'</span>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link status:</label>
                                    <span class="inline">'.$checkedFlag.'</span>
                            </div>

                            </fieldset>

                            <div class="control-group">
                            <label class="control-label"></label>
                                <div class="controls">
                                <a href="/Link/ViewEditLink/?linkid='.$data["id"].'" class="btn btn-primary">Edit link</a>
                                <button class="btn btn-primary delete-link-button" id='.$data["id"].' name = "deletelinkbutton">Delete link</button>
                                </div>
                            </div>';
        $this->template .= $popupConfirm->template;
    }
}

