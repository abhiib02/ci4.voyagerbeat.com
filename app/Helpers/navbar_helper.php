<?php
if (! function_exists('seasonNav')) {
  function seasonNav()
  {
    $monthNumber = date("m");
    $monthNavArr = array(
      '01' => '
      <li class="nav-item">
        <a class="nav-link" href="/packages/Kedarkantha">Kedarkantha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '02' => '
      <li class="nav-item">
        <a class="nav-link" href="/packages/Kedarkantha">Kedarkantha</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '03' => '
      <li class="nav-item">
        <a class="nav-link" href="/tags/holi">Holi Trips</a>
      </li>
    ',
      '04' => '',
      '05' => '',
      '06' => '',
      '07' => '',
      '08' => '',
      '09' => '',
      '10' => '',
      '11' => '
      <li class="nav-item">
        <a class="nav-link" href="/type/xmas-new-year">Xmas & New Year</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/packages/kedarkantha">Kedarkantha</a>
      </li>
    ',
      '12' => '
      <li class="nav-item">
        <a class="nav-link" href="/type/xmas-new-year">Xmas & New Year</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/packages/kedarkantha">Kedarkantha</a>
      </li>
    '
    );
    return $monthNavArr[$monthNumber];
  }
}
if (! function_exists('seasonNavMobile')) {
  function seasonNavMobile()
  {
    $monthNumber = date("m");
    $monthNavArr = array(
      '01' => '
      <a class="list-group-item list-group-item-action" href="/packages/Kedarkantha">Kedarkantha</a>
      <a class="list-group-item list-group-item-action" href="/tags/holi">Holi Trips</a>
      ',
      '02' => '
      <a class="list-group-item list-group-item-action" href="/packages/Kedarkantha">Kedarkantha</a>
      <a class="list-group-item list-group-item-action" href="/tags/holi">Holi Trips</a>
    ',
      '03' => '
      <a class="list-group-item list-group-item-action" href="/tags/holi">Holi Trips</a>
    ',
      '04' => '',
      '05' => '',
      '06' => '',
      '07' => '',
      '08' => '',
      '09' => '',
      '10' => '',
      '11' => '
      <a class="list-group-item list-group-item-action" href="/type/xmas-new-year">Xmas & New Year</a>
      <a class="list-group-item list-group-item-action" href="/packages/kedarkantha">Kedarkantha</a>
      ',
      '12' => '
      <a class="list-group-item list-group-item-action" href="/type/xmas-new-year">Xmas & New Year</a>
      <a class="list-group-item list-group-item-action" href="/packages/kedarkantha">Kedarkantha</a>
    '
    );
    return $monthNavArr[$monthNumber];
  }
}
