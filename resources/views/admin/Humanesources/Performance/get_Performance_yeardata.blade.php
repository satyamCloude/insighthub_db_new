 <tr>
                  <td>Task</td>
                  <td>{{$peroid}}</td>
                  <td>{{$TotalTaskAssigned}}</td>
                  <td>{{$TotalTaskComplete}}</td>
                  @if ($TotalTaskAssigned > 0)
                      @php
                          $percentage = ($TotalTaskComplete / $TotalTaskAssigned) * 100;
                      @endphp

                      @if ($percentage >= 95)
                          <td><span class="text-success" >{{ round($percentage, 2) }}% </span></td>
                          <td><span class="text-success" >Outstanding performance</span></td>
                      @elseif ($percentage >= 75 && $percentage < 95)
                          <td><span class="text-primary" >{{ round($percentage, 2) }}% </span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($percentage >= 60 && $percentage < 75)
                          <td><span class="text-warning" >{{ round($percentage, 2) }}% </span></td>
                          <td><span class="text-warning" >Meets Expectations</span></td>
                      @elseif ($percentage >= 45 && $percentage < 60)
                          <td><span class="text-danger" >{{ round($percentage, 2) }}% </span></td>
                          <td><span class="text-danger" >Needs Improvement</span></td>
                      @else
                          <td><span class="text-secondary" >{{ round($percentage, 2) }}% </span></td>
                          <td><span class="text-secondary" >Unacceptable</span></td>
                      @endif
                      @else
                     <td></td>
                     <td></td>
                  @endif
              </tr>
              <tr>
                  <td>Project</td>
                  <td>{{$peroid}}</td>
                  <td>{{$TotalProjectAssigned}}</td>
                  <td>{{$TotalProjectComplete}}</td>
                  @if ($TotalProjectAssigned > 0)
                      @php
                          $Ppercentage = ($TotalProjectComplete / $TotalProjectAssigned) * 100;
                      @endphp

                      @if ($Ppercentage >= 95)
                           <td><span class="text-success" >{{ round($Ppercentage, 2) }}%</span></td>
                          <td><span class="text-success" >Outstanding performance </span></td>
                      @elseif ($Ppercentage >= 75 && $Ppercentage < 95)
                           <td><span class="text-primary" >{{ round($Ppercentage, 2) }}%</span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($Ppercentage >= 60 && $Ppercentage < 75)
                           <td><span class="text-warning" >{{ round($Ppercentage, 2) }}%</span></td>
                          <td><span class="text-warning" >Needs Improvement</span></td>
                      @elseif ($Ppercentage >= 45 && $Ppercentage < 60)
                           <td><span class="text-danger" >{{ round($Ppercentage, 2) }}%</span></td>
                          <td><span class="text-danger" >Unacceptable</span></td>
                      @else
                           <td><span class="text-secondary" >{{ round($Ppercentage, 2) }}%</span></td>
                          <td><span class="text-secondary" >Meets Expectations</span></td>
                      @endif
                      @else
                     <td></td>
                     <td></td>
                  @endif
              </tr>
              <tr>
                  <td>Goal</td>
                  <td>{{$peroid}}</td>
                  <td>{{$TotalGoalAssigned}}</td>
                  <td>{{$TotalGoalComplete}}</td>
                  @if ($TotalGoalAssigned > 0)
                      @php
                          $Gpercentage = ($TotalGoalComplete / $TotalGoalAssigned) * 100;
                      @endphp

                      @if ($Gpercentage >= 95)
                          <td><span class="text-success" >{{ round($Gpercentage, 2) }}%</span></td>
                          <td><span class="text-success" >Outstanding performance </span></td>
                      @elseif ($Gpercentage >= 75 && $Gpercentage < 95)
                          <td><span class="text-primary" >{{ round($Gpercentage, 2) }}%</span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($Gpercentage >= 60 && $Gpercentage < 75)
                          <td><span class="text-warning" >{{ round($Gpercentage, 2) }}%</span></td>
                          <td><span class="text-warning" >Meets Expectations</span></td>
                      @elseif ($Gpercentage >= 45 && $Gpercentage < 60)
                          <td><span class="text-danger" >{{ round($Gpercentage, 2) }}%</span></td>
                          <td><span class="text-danger" >Needs Improvement</span></td>
                      @else
                          <td><span class="text-secondary" >{{ round($Gpercentage, 2) }}%</span></td>
                          <td><span class="text-secondary" >Unacceptable</span></td>
                      @endif
                      @else
                     <td></td>
                     <td></td>
                  @endif
              </tr>
              <tr>
                  <td>Leads</td>
                  <td>{{$peroid}}</td>
                  <td>{{$TotalLeadAssigned}}</td>
                  <td>{{$TotalLeadComplete}}</td>
                  @if ($TotalLeadAssigned > 0)
                      @php
                          $Lpercentage = ($TotalLeadComplete / $TotalLeadAssigned) * 100;
                      @endphp

                      @if ($Lpercentage >= 95)
                           <td><span class="text-success" >{{ round($Lpercentage, 2) }}%</span></td>
                          <td><span class="text-success" >Outstanding performance </span></td>
                      @elseif ($Lpercentage >= 75 && $Lpercentage < 95)
                           <td><span class="text-primary" >{{ round($Lpercentage, 2) }}%</span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($Lpercentage >= 60 && $Lpercentage < 75)
                           <td><span class="text-warning" >{{ round($Lpercentage, 2) }}%</span></td>
                          <td><span class="text-warning" >Meets Expectations</span></td>
                      @elseif ($Lpercentage >= 45 && $Lpercentage < 60)
                           <td><span class="text-danger" >{{ round($Lpercentage, 2) }}%</span></td>
                          <td><span class="text-danger" >Needs Improvement</span></td>
                      @else
                           <td><span class="text-secondary" >{{ round($Lpercentage, 2) }}%</span></td>
                          <td><span class="text-secondary" >Unacceptable</span></td>
                      @endif
                      @else
                     <td></td>
                     <td></td>
                  @endif
              </tr>
              <tr>
                  <td>Quotes</td>
                  <td>{{$peroid}}</td>
                  <td>{{$TotalQuotesAssigned}}</td>
                  <td>{{$TotalQuotesComplete}}</td>
                  @if ($TotalQuotesAssigned > 0)
                      @php
                          $Qpercentage = ($TotalQuotesComplete / $TotalQuotesAssigned) * 100;
                      @endphp

                      @if ($Qpercentage >= 95)
                          <td><span class="text-success" >{{ round($Qpercentage, 2) }}%</span></td>
                          <td><span class="text-success" >Outstanding performance </span></td>
                      @elseif ($Qpercentage >= 75 && $Qpercentage < 95)
                          <td><span class="text-primary" >{{ round($Qpercentage, 2) }}%</span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($Qpercentage >= 60 && $Qpercentage < 75)
                          <td><span class="text-warning" >{{ round($Qpercentage, 2) }}%</span></td>
                          <td><span class="text-warning" >Meets Expectations</span></td>
                      @elseif ($Qpercentage >= 45 && $Qpercentage < 60)
                          <td><span class="text-danger" >{{ round($Qpercentage, 2) }}%</span></td>
                          <td><span class="text-danger" >Needs Improvement</span></td>
                      @else
                          <td><span class="text-secondary" >{{ round($Qpercentage, 2) }}%</span></td>
                          <td><span class="text-secondary" >Unacceptable</span></td>
                      @endif
                      @else
                     <td></td>
                     <td></td>
                  @endif
              </tr>
              <tr>
                  <td>Attendance</td>
                  <td>{{$peroid}}</td>
                  <td>{{$totalDays}} Days</td>
                  <td>{{$TotalAttendence}} Present</td>
                    @if ($TotalAttendence > 0)
                      @php
                          $Apercentage = ($TotalAttendence / $totalDays) * 100;
                      @endphp
                      @if ($Apercentage >= 95)
                          <td><span class="text-success" >{{ round($Apercentage, 2) }}%</span></td>
                          <td><span class="text-success" >Outstanding performance </span></td>
                      @elseif ($Apercentage >= 75 && $Apercentage < 95)
                          <td><span class="text-primary" >{{ round($Apercentage, 2) }}%</span></td>
                          <td><span class="text-primary" >Exceeding Expectations</span></td>
                      @elseif ($Apercentage >= 60 && $Apercentage < 75)
                          <td><span class="text-warning" >{{ round($Apercentage, 2) }}%</span></td>
                          <td><span class="text-warning" >Meets Expectations</span></td>
                      @elseif ($Apercentage >= 45 && $Qpercentage < 60)
                          <td><span class="text-danger" >{{ round($Apercentage, 2) }}%</span></td>
                          <td><span class="text-danger" >Needs Improvement</span></td>
                      @else
                          <td><span class="text-secondary" >{{ round($Apercentage, 2) }}%</span></td>
                          <td><span class="text-secondary" >Unacceptable</span></td>
                      @endif
                    @else
                      <td></td>
                      <td></td>
                    @endif
              </tr>