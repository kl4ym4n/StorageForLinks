<?php
class ViewPublicLinks extends View
{
    public function __construct($data)
    {
        //echo $this->data[0]['header'];
        //echo $data[0]['header'];
        //echo 'lolo';
        $linkPath = 'Link/PublicLinks';
        $pager = new ViewPagination($data[2], $data[3], $linkPath);
        $this->template = '<div class="container">

                           <legend>Public links</legend>
                              <table class="table">
                                <thead>
                                  <tr>';
                            //data[1] - array from db table, data[0] - array of id, data[2] - page, data[3] - pageCount, data[4] - limit
                            foreach (array_keys($data[1][0]) as $title)
                            {
                                    $this->template .= ' <th>' . $title .' </th>';
                            }
                            //button field
                            $this->template .= ' <th>Link info</th>';

        $this->template =   $this->template .
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
                                        $this->template .= ' <td><a href="/Link/ViewPublicLink/?linkid='.$data[0][$i].'" class="btn btn-primary">Link info</a></td> </tr>';
                                        $i++;
                                }
        $this->template .= ' </tbody>
                              </table>';
                                $this->template .= $pager->template;

        $this->template .= '</div>';

    }
}