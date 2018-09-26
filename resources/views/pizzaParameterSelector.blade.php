<form action="/getPizzaPlaces" method="post">
  {{csrf_field()}}
  <span>Choose pizza places in</span>
  <select name="citySelector">
    <option value='{"entityId":"1051","entityType":"city"}'>Oklahoma City</option>
    <option value='{"entityId":"124138","entityType":"subzone"}'>Norman</option>
  </select>
  <span> in a </span>
  <select name="distanceSelector">
    <option value="5">5</option>
    <option value="10">10</option>
  </select>
  <span> mile radius!</span>

  <button type="submit">Find the Pizza!</button>
</form>
