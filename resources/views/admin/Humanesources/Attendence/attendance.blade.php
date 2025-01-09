 @foreach($attendances as $attendance)
                        <tr>
                            <td>#{{$attendance->emp_Id}}</td>
                            <td>{{$attendance->punch_date}}</td>
                            <td>{{$attendance->punch_in}}</td>
                            <td>{{$attendance->punch_out}}</td>
                            <td>{{$attendance->working_hours}}</td>
                            <td>
                                @php 
                                // Extract hours and minutes from ts_working_hrs
                                list($hours, $minutes) = explode(':', $attendance->ts_working_hrs);
                                
                                // Calculate total hours
                                $total_hours = intval($hours) + intval($minutes) / 60;
                                
                                // Calculate overtime
                                $overtime = $attendance->working_hours - $total_hours;
                                @endphp
                                {{$overtime > 0 ? $overtime : 0}}
                            </td>
                        </tr>
                    @endforeach