<?php
class ViewPublicLinks extends View
{
    public function __construct($data)
    {
        //echo $this->data[0]['header'];
        //echo $data[0]['header'];
        //echo 'lolo';
        $this->template = '<div class="container">

                           <legend>Public links</legend>
                              <table class="table">
                                <thead>
                                  <tr>';
                            //data[1] - array from db table, data[0] - array of id, data[2] - page, data[3] - pageCount, data[4] - limit
                            foreach (array_keys($data[1][0]) as $title)
                            {
                                    $this->template = $this->template .' <th>' . $title .' </th>';
                            }
                            //button field
                            $this->template = $this->template .' <th>Link info</th>';

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
                                        $this->template = $this->template . ' <td><a href="/Link/ViewLink/?linkid='.$data[0][$i].'" class="btn btn-primary">Link info</a></td> </tr>';
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
                                            $this->template = $this->template .'<li class="active"><a href="/Link/PublicLinks/?page='.$data[2].'">'.$currPage.'</a>
                                                                                <li>
                                                                                <a href="/Link/PublicLinks/?page='.$nextPage.'" aria-label="Next">
                                                                                <span aria-hidden="true">&raquo;</span>
                                                                                </a>';
                                        }
                                        else if (($data[2] + 1) == $data[3])
                                        {
                                            $currPage =  $data[2] + 1;
                                            $prevPage = $data[2] - 1;
                                            $this->template = $this->template . '<a href="/Link/PublicLinks/?page='.$prevPage.'" aria-label="Previous">
                                                                                    <span aria-hidden="true">&laquo;</span>
                                                                                  </a>
                                                                                </li>
                                                                                <li class="active"> <a href="/Link/PublicLinks/?page='.$data[2].'">'.$currPage.'</a>';
                                        }
                                        else  if ($data[2] != 0 &&  ($data[2] + 1) != $data[3] && ($data[3] - $data[2]) > 1 )
                                        {
                                            $currPage =  $data[2] + 1;
                                            $nextPage = $data[2] + 1;
                                            $prevPage = $data[2] - 1;
                                            $this->template = $this->template . '<a href="/Link/PublicLinks/?page='.$prevPage.'" aria-label="Previous">
                                                                                    <span aria-hidden="true">&laquo;</span>
                                                                                 </a></li>
                                                                                <li class="active"> <a href="/Link/PublicLinks/?page='.$data[2].'">'.$currPage.'</a>
                                                                                <li><a href="/Link/PublicLinks/?page='.$nextPage.'" aria-label="Next">
                                                                                <span aria-hidden="true">&raquo;</span>
                                                                                </a>';

                                        }

    $this->template =   $this->template .'</li>
                                  </ul>
                                </nav>
                            </div>';

    }
}