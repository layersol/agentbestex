@include('layouts.header')

<div class="bodyload" style="margin-top:80px;display:none">
 <div class="rotatingDiv"></div>
</div>

<main>
  <!-- ✅ Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- ✅ Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }

    .flight-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.08);
      padding: 20px;
      transition: all 0.3s ease;
     
      overflow: hidden;
      position: relative;
      margin-bottom: 10px;
    }

    .flight-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    .flight-logo img {
      width: 70px;
      margin-bottom: 5px;
    }

    .flight-number {
      font-weight: 500;
      color: #555;
      margin-bottom: 10px;
      font-size: 15px;
    }

    .flight-route {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 8px;
      flex-wrap: wrap;
    }

    .flight-route h5 {
      font-weight: 600;
      margin-bottom: 3px;
      font-size: 17px;
    }

    .flight-route p {
      margin: 0;
      font-size: 13px;
      color: #666;
    }

    .flight-duration {
      font-size: 13px;
      color: #555;
      margin: 10px 0;
    }

    .non-refundable {
      display: inline-block;
      background: #555;
      color: #fff;
      border-radius: 4px;
      font-size: 12px;
      padding: 3px 8px;
      margin-bottom: 8px;
    }

    .seats-left {
      font-size: 13px;
      color: #e74c3c;
      margin-bottom: 8px;
    }

    .price {
      color: #e21b1b;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .btn-select {
      background: #007bff;
      color: white;
      font-weight: 600;
      border-radius: 6px;
      width: 100%;
      padding: 10px;
      border: none;
      transition: 0.3s;
    }

    .btn-select:hover {
      background: #0056b3;
    }

    /* ✅ Details section with slide animation */

.details-right {
    flex: 1;
    min-width: 300px;
    border-left: 1px solid #eee;
    padding-left: 20px;
}

.counter {
    display: flex
;
    align-items: center;
    justify-content: space-between;
    margin: 10px 0;
}


.counter button.minus {
    background: #d9534f;
}

.counter button {
    width: 32px;
    height: 32px;
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
}
.counter input {
    width: 50px;
    text-align: center;
    border: none;
    font-size: 16px;
    background: #f3f3f3;
    border-radius: 6px;
}
.counter button.plus {
    background: #5cb85c;
}
.counter button {
    width: 32px;
    height: 32px;
    border: none;
    color: white;
    font-size: 18px;
    border-radius: 6px;
    cursor: pointer;
}
.total {
    font-size: 22px;
    color: #e60000;
    font-weight: bold;
    text-align: right;
    margin-top: 10px;
}

.book-btn {
    background: #e60000;
    color: white;
    border: none;
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    font-size: 18px;
    margin-top: 10px;
    cursor: pointer;
}

.flight-details {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.4s ease;
      opacity: 0;
      background: #fff;
      border-top: 1px solid #eee;
      border-radius: 0 0 8px 8px;
      /* margin-top: 15px; */
      padding: 0 15px;
    }

    .flight-details.active {
      max-height: 100%;
      opacity: 1;
      padding: 15px;
    }

    .flight-details ul {
      margin: 0;
      padding-left: 18px;
      font-size: 14px;
      color: #444;
    }

    /* ✅ Desktop Layout */
    @media (min-width: 768px) {
      .flight-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-align: left;
        gap: 25px;
        flex-wrap: nowrap;
      }

      .flight-logo {
        flex: 0 0 120px;
        text-align: center;
      }

      .flight-route {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex: 1;
        text-align: center;
      }

      .flight-route > div {
        flex: 1;
      }

      .flight-price-section {
        flex: 0 0 180px;
        text-align: center;
      }

      .btn-select {
        width: 100%;
      }
    }

    /* ✅ Mobile Layout */
    @media (max-width: 767px) {
      .flight-card {
        text-align: center;
        padding: 15px;
        flex-direction: column;
      }

      .flight-logo {
        order: -1;
        text-align: center;
        margin-bottom: 10px;
      }

      .flight-number {
        text-align: center;
        margin-bottom: 15px;
      }

      .flight-route {
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        width: 100%;
      }

      .flight-price-section {
        width: 100%;
        text-align: center;
        margin-top: 15px;
      }

      .price {
        font-size: 20px;
        margin-bottom: 8px;
      }

      .btn-select {
        width: 80%;
        margin: 0 auto;
        display: inline-block;
      }
    }
    .flight-details {
  display: none;
  transition: all 0.3s ease-in-out;
}
.flight-details.active {
  display: block;
}
  </style>

  <div class="container py-4" style="margin-top:80px;">
    <div class="row g-4">
      
      <div class="col-12">

@if (empty($result))
  <div class="empty">No flights found for your search.</div>
@else
  @foreach ($result as $row)

<?php  

// print_r($row);
?>

        <div class="flight-card">
          <div class="flight-logo">
            <img src="https://assets.duffel.com/img/airlines/for-light-background/full-color-logo/{{ $row['airline_code'] }}.svg" alt="Airline Logo">
            <div class="flight-number mt-2">{{ $row['airline_name'] }} • {{ $row['number'] }}</div>
          </div>

          <div class="flight-route">
            <div>
              <h5>{{ date('H:i', strtotime($row['departure_time'])) }}</h5>
              <p>{{ strtoupper($row['departure_airport']) }} ({{ strtoupper($row['departure_city']) }})</p>
            </div>
            <div>
              <i class="fa-solid fa-plane"></i>
               @php
          $departure = new DateTime($row['departure_time']);
          $arrival = new DateTime($row['arrival_time']);
          $interval = $departure->diff($arrival);
          $duration = $interval->format('%h hr %i min');
        @endphp
       
              <p class="flight-duration mb-0">{{ $duration }}</p>
              <hr>
        <i class="fa-solid fa-suitcase-rolling"></i> {{ $row['baggaes'] }} KG
            </div>
            <div>
              <h5>{{ date('H:i', strtotime($row['arrival_time'])) }}</h5>
              <p>{{ strtoupper($row['arrival_airport']) }} ({{ strtoupper($row['arrival_city']) }})</p>
            </div>
          </div>

          <div class="flight-price-section">
            <span class="non-refundable">Non Refundable</span>
            <div class="seats-left">{{ $row['seats'] }} seats left</div>
            <div class="price">₹{{ number_format($row['adult_price'], 2) }}</div>
            <input type="hidden" id="seatAvailable{{ $row['id'] }}" value="{{ $row['seats'] }}">
            <button class="btn-select" data-id="{{ $row['id'] }}">
              Select</button>
          </div>
        </div>

        <!-- ✅ Properly nested details section -->
        <div class="flight-details mt-3" id="details-{{ $row['id'] }}" style="display: none;">
          <h6><i class="fa-solid fa-circle-info text-primary me-1"></i> Flight Details</h6>
          <div class="row">
            <div class="col-lg-6">
             <div class="details-left">
       
        <p><strong>Departure:</strong>  (LHR) – 2025-10-30, 04:58:AM</p>
        <p><strong>Arrival:</strong>  (JFK) – 2025-10-30, 08:58:AM</p>

        <div class="price-list">
          <p>Adult: INR <span id="adultPrice1">100.00</span></p>
          <p>Child: INR <span id="childPrice1">100.00</span></p>
          <p>Infant: INR <span id="infantPrice1">200.00</span></p>
        </div>
      </div>
            </div>

            <div class="col-lg-6">
              <div class="details-right">
        <div class="counter">
          <span>Adult</span>
          <div>
            <button class="minus" onclick="updateCount(1, 'adult', -1)">-</button>
            <input type="text" id="adultCount1" value="1" readonly="">
            <button class="plus" onclick="updateCount(1, 'adult', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Child</span>
          <div>
            <button class="minus" onclick="updateCount(1, 'child', -1)">-</button>
            <input type="text" id="childCount1" value="0" readonly="">
            <button class="plus" onclick="updateCount(1, 'child', 1)">+</button>
          </div>
        </div>

        <div class="counter">
          <span>Infant</span>
          <div>
            <button class="minus" onclick="updateCount(1, 'infant', -1)">-</button>
            <input type="text" id="infantCount1" value="0" readonly="">
            <button class="plus" onclick="updateCount(1, 'infant', 1)">+</button>
          </div>
        </div>

        <div class="total">INR <span id="totalFare1">100.00</span></div>
        
        <form method="POST" action="https://agentbestex.com/book-flight">
  <input type="hidden" name="_token" value="UFzdQQRSIezXmXGG0J5lQQnIpNn4A4tggzAwzSPX" autocomplete="off">
  <!-- Hidden fields to send data -->
  <input type="hidden" name="flight" value="{&quot;id&quot;:1,&quot;route_id&quot;:1,&quot;departure_airport&quot;:&quot;LHR&quot;,&quot;arrival_airport&quot;:&quot;JFK&quot;,&quot;departure_date&quot;:&quot;2025-10-30&quot;,&quot;return_date&quot;:&quot;2025-10-30&quot;,&quot;departure_time&quot;:&quot;04:58:43&quot;,&quot;arrival_time&quot;:&quot;08:58:43&quot;,&quot;airline_id&quot;:1,&quot;code&quot;:&quot;QA&quot;,&quot;number&quot;:&quot;315&quot;,&quot;baggaes&quot;:&quot;30&quot;,&quot;seats&quot;:9,&quot;adult_price&quot;:&quot;100.00&quot;,&quot;child_price&quot;:&quot;100.00&quot;,&quot;infant_price&quot;:&quot;200.00&quot;,&quot;currency&quot;:&quot;INR&quot;,&quot;status&quot;:&quot;YES&quot;,&quot;created_at&quot;:null,&quot;updated_at&quot;:null,&quot;departure_airport_name&quot;:&quot;London Heathrow Airport&quot;,&quot;arrival_airport_name&quot;:&quot;John F Kennedy International Airport&quot;,&quot;airline_name&quot;:&quot;135 Airways&quot;,&quot;airline_code&quot;:&quot;&quot;}">

  <input type="hidden" name="flight_id" value="1">
  <input type="hidden" name="adult_count" id="adultInput1" value="1">
  <input type="hidden" name="child_count" id="childInput1" value="0">
  <input type="hidden" name="infant_count" id="infantInput1" value="0">
  <input type="hidden" name="total_fare" id="fareInput1" value="100.00">

  <button type="submit" class="book-btn">BOOK NOW</button>
</form>
      </div>
            </div>
          </div>
        </div>


  @endforeach
@endif



      </div> <!-- /col-12 -->
    </div> <!-- /row -->
  </div> <!-- /container -->

  <script>
document.addEventListener("DOMContentLoaded", function() {
  // Toggle details (only one open at a time)
  document.querySelectorAll(".btn-select").forEach(button => {
    button.addEventListener("click", function() {
      const id = this.dataset.id;
      const target = document.getElementById("details-" + id);

      document.querySelectorAll(".flight-details").forEach(detail => {
        if (detail !== target) detail.classList.remove("active");
      });

      target.classList.toggle("active");
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  });
});




function updateCount(id, type, change) {
  const adultInput = document.getElementById("adultCount" + id);
  const childInput = document.getElementById("childCount" + id);
  const infantInput = document.getElementById("infantCount" + id);
  let adult = parseInt(adultInput.value);
  let child = parseInt(childInput.value);
  let infant = parseInt(infantInput.value);
  const seatsLeft = parseInt(document.getElementById("seatAvailable" + id).value);
  let newCount = 0;

  if (type === 'adult') newCount = adult + change;
  if (type === 'child') newCount = child + change;
  if (type === 'infant') newCount = infant + change;

  if (newCount < 0) newCount = 0;
  let totalAdultChild = (type === 'adult' ? newCount : adult) + (type === 'child' ? newCount : child);
  if (totalAdultChild > seatsLeft) newCount = (type === 'adult' ? seatsLeft - child : seatsLeft - adult);
  if (type === 'infant' && newCount > adult) newCount = adult;
  if (type === 'adult' && newCount < infant) infantInput.value = newCount;

  if (type === 'adult') adultInput.value = newCount;
  if (type === 'child') childInput.value = newCount;
  if (type === 'infant') infantInput.value = newCount;
  calculateTotal(id);
}

function calculateTotal(id) {
  const adult = parseInt(document.getElementById("adultCount" + id).value);
  const child = parseInt(document.getElementById("childCount" + id).value);
  const infant = parseInt(document.getElementById("infantCount" + id).value);
  const adultPrice = parseFloat(document.getElementById("adultPrice" + id).textContent);
  const childPrice = parseFloat(document.getElementById("childPrice" + id).textContent);
  const infantPrice = parseFloat(document.getElementById("infantPrice" + id).textContent);
  const total = (adult * adultPrice) + (child * childPrice) + (infant * infantPrice);
  document.getElementById("totalFare" + id).textContent = total.toLocaleString("en-IN", {minimumFractionDigits: 2});
}
</script>


</main>

@include('layouts.footer')