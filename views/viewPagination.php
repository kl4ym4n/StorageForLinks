<?php
class ViewPagination extends View
{
    public function __construct($page, $pageCount, $linkPath)
    {
        $this->template = '<nav
                              <ul class="pagination">
                                  <li>';
                                    if ($page == 0)
                                    {
                                        $currPage =  $page + 1;
                                        $nextPage = $page + 1;
                                        $this->template .= '<li class="active"><a href="/'.$linkPath.'/?page='.$page.'">'.$currPage.'</a>
                                                                                                            <li>
                                                                                                            <a href="/'.$linkPath.'/?page='.$nextPage.'" aria-label="Next">
                                                                                                            <span aria-hidden="true">&raquo;</span>
                                                                                                            </a>';
                                    }
                                    else if (($page + 1) == $pageCount)
                                    {
                                        $currPage =  $page + 1;
                                        $prevPage = $page - 1;
                                        $this->template .= '<a href="/'.$linkPath.'/?page='.$prevPage.'" aria-label="Previous">
                                                                                                                <span aria-hidden="true">&laquo;</span>
                                                                                                              </a>
                                                                                                            </li>
                                                                                                            <li class="active"> <a href="/'.$linkPath.'/?page='.$page.'">'.$currPage.'</a>';
                                    }
                                    else if ($page != 0 &&  ($page + 1) != $pageCount && ($pageCount - $page) > 1 )
                                    {
                                        $currPage =  $page + 1;
                                        $nextPage = $page + 1;
                                        $prevPage = $page - 1;
                                        $this->template .= '<a href="/'.$linkPath.'/?page='.$prevPage.'" aria-label="Previous">
                                                                                                                <span aria-hidden="true">&laquo;</span>
                                                                                                             </a></li>
                                                                                                            <li class="active"> <a href="/'.$linkPath.'/?page='.$page.'">'.$currPage.'</a>
                                                                                                            <li><a href="/'.$linkPath.'/?page='.$nextPage.'" aria-label="Next">
                                                                                                            <span aria-hidden="true">&raquo;</span>
                                                                                                            </a>';

                                    }
        $this->template .=        '</li>
                              </ul>
                           </nav>';

    }
}