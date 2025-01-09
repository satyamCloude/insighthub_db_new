@if(count($Attendence) > 0)
  @foreach($Attendence as $key => $att)
    <tr class="odd">
      <td>{{ $key+1 }} </td>
      <td>{{ $att->punch_date }}</td>
      <td class="punch-in">{{ $att->punch_in }}</td>
      <td class="punch-out">{{ $att->punch_out }}</td>
      <td class="total-time">Calculating...</td>
    </tr>
  @endforeach
  <tr>
    <td class="text-center" colspan="3"></td>
    <td><b>Grand Total Time</b></td>
    <td ><b><span id="grand-total-time">Calculating...</span></b></td>
  </tr>
@else
  <tr>
    <td class="text-center" colspan="5">No Data Found</td>
  </tr>
@endif
<script>
  $(document).ready(function() {
    var grandTotalSeconds = 0;

    $('.odd').each(function() {
      var punchIn = $(this).find('.punch-in').text();
      var punchOut = $(this).find('.punch-out').text();

      var diff = calculateTimeDifference(punchIn, punchOut);
      $(this).find('.total-time').text(formatTimeDifference(diff));

      // Accumulate the total in seconds
      grandTotalSeconds += calculateTotalSeconds(diff);
    });

    // Display the grand total time
    $('#grand-total-time').text(formatTotalTime(grandTotalSeconds));

    function calculateTimeDifference(start, end) {
      var startTime = new Date("2000-01-01 " + start);
      var endTime = new Date("2000-01-01 " + end);

      var timeDiff = endTime - startTime; // Difference in milliseconds

      // Calculate hours, minutes, and seconds
      var hours = Math.floor(timeDiff / 3600000); // 1 hour = 3600000 milliseconds
      var minutes = Math.floor((timeDiff % 3600000) / 60000); // 1 minute = 60000 milliseconds
      var seconds = Math.floor((timeDiff % 60000) / 1000); // 1 second = 1000 milliseconds

      return {
        hours: hours,
        minutes: minutes,
        seconds: seconds
      };
    }

    function calculateTotalSeconds(diff) {
      return diff.hours * 3600 + diff.minutes * 60 + diff.seconds;
    }

    function formatTotalTime(totalSeconds) {
      var hours = Math.floor(totalSeconds / 3600);
      var minutes = Math.floor((totalSeconds % 3600) / 60);
      var seconds = totalSeconds % 60;

      return padZero(hours) + ':' + padZero(minutes) + ':' + padZero(seconds);
    }

    function formatTimeDifference(diff) {
      return padZero(diff.hours) + ':' + padZero(diff.minutes) + ':' + padZero(diff.seconds);
    }

    function padZero(value) {
      return value < 10 ? '0' + value : value;
    }
  });
</script>