<?php
class ViewUserList extends View
{
    public function __construct($data)
    {
        $linkPath = 'User/AllUsers';
        $pager = new ViewPagination($data[2], $data[3], $linkPath);
        $popupConfirm = new ViewConfirmDelete();
        $this->template =
            '<div class="container">
                           <legend>Users</legend>
                              <table class="table">
                                <thead>
                                  <tr>';
                                    //data[0] - array of id, data[1] - array from db table, data[2] - page, data[3] - pageCount, data[4] - limit
                                    foreach (array_keys($data[1][0]) as $title)
                                    {
                                        $this->template .= ' <th>' . $title .' </th>';
                                    }
                                    //button field
                                    $this->template .= ' <th>Edit user</th>';
                                    $this->template .= ' <th>Delete user</th>';

        $this->template .=
                                '</tr>
                                </thead>
                                <tbody>';
                                            $i = 0;
                                            foreach ($data[1] as $row)
                                            {
                                                $this->template .= ' <tr>';

                                                foreach (array_values($row) as $value)
                                                {
                                                    $this->template .= ' <td>' . $value .' </td>';
                                                }
                                                $this->template .= ' <td><a href="/User/EditUserProfile/?userid='.$data[0][$i].'" class="btn btn-primary">Edit User</a></td>';
                                                $this->template .= ' <td><button id='.$data[0][$i].' class="btn btn-primary delete-user-button">Delete User</button></td> </tr>';
                                                $i++;
                                            }
        $this->template .=  '</tbody>
                              </table>';
                                $this->template .= $pager->template;
        $this->template .=   '</div>';
        $this->template .= $popupConfirm->template;
    }
}