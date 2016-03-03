<?php
class ViewUserList extends View
{
    public function __construct($data)
    {
        $this->template = $this->template =
            '<div class="container">
                           <legend>Users</legend>
                              <table class="table">
                                <thead>
                                  <tr>';
                                    //data[1] - array from db table, data[0] - array of id, data[2] - page, data[3] - pageCount, data[4] - limit
                                    foreach (array_keys($data[1][0]) as $title)
                                    {
                                        $this->template = $this->template .' <th>' . $title .' </th>';
                                    }
                                    //button field
                                    $this->template = $this->template .' <th>Edit user</th>';
                                    $this->template = $this->template .' <th>Delete user</th>';

        $this->template =   $this->template .
                                '</tr>
                                </thead>
                                <tbody>';
                                            $i = 0;
                                            foreach ($data[1] as $row)
                                            {
                                                $this->template = $this->template .' <tr>';

                                                foreach (array_values($row) as $value)
                                                {
                                                    $this->template = $this->template .' <td>' . $value .' </td>';
                                                }
                                                $this->template = $this->template . ' <td><a href="/User/ViewProfile/?userid='.$data[0][$i].'" class="btn btn-primary">Edit User</a></td>';
                                                $this->template = $this->template . ' <td><a href="/User/EditProfile/?userid='.$data[0][$i].'" class="btn btn-primary">Delete User</a></td> </tr>';
                                                $i++;
                                            }
        $this->template =   $this->template .'
                                </tbody>
                              </table>
                                <nav>
                                  <ul class="pagination">
                                    <li>';
                                                if ($data[2] == 0)
                                                {
                                                    $currPage =  $data[2] + 1;
                                                    $nextPage = $data[2] + 1;
                                                    $this->template = $this->template .'<li class="active"><a href="/User/AllUsers/?page='.$data[2].'">'.$currPage.'</a>
                                                                                                                        <li>
                                                                                                                        <a href="/User/AllUsers/?page='.$nextPage.'" aria-label="Next">
                                                                                                                        <span aria-hidden="true">&raquo;</span>
                                                                                                                        </a>';
                                                }
                                                else if (($data[2] + 1) == $data[3])
                                                {
                                                    $currPage =  $data[2] + 1;
                                                    $prevPage = $data[2] - 1;
                                                    $this->template = $this->template . '<a href="/User/AllUsers/?page='.$prevPage.'" aria-label="Previous">
                                                                                                                            <span aria-hidden="true">&laquo;</span>
                                                                                                                          </a>
                                                                                                                        </li>
                                                                                                                        <li class="active"> <a href="/User/AllUsers/?page='.$data[2].'">'.$currPage.'</a>';
                                                }
                                                else if ($data[2] != 0 &&  ($data[2] + 1) != $data[3] && ($data[3] - $data[2]) > 1 )
                                                {
                                                    $currPage =  $data[2] + 1;
                                                    $nextPage = $data[2] + 1;
                                                    $prevPage = $data[2] - 1;
                                                    $this->template = $this->template . '<a href="/User/AllUsers/?page='.$prevPage.'" aria-label="Previous">
                                                                                                                            <span aria-hidden="true">&laquo;</span>
                                                                                                                         </a></li>
                                                                                                                        <li class="active"> <a href="/User/AllUsers/?page='.$data[2].'">'.$currPage.'</a>
                                                                                                                        <li><a href="/User/AllUsers/?page='.$nextPage.'" aria-label="Next">
                                                                                                                        <span aria-hidden="true">&raquo;</span>
                                                                                                                        </a>';

                                                }

        $this->template =   $this->template .'</li>
                                  </ul>
                                </nav>
                            </div>';
    }
}