# parkingplace

Welcome to Parking Place! Where you can park with just your phone.

Try out our service at [https://parkingplace.nickdown.com](https://parkingplace.nickdown.com)

If you would like to install yourself, please note that in addition to the normal Laravel installation requirements, you will also have to run `php artisan passport:keys`. This allows Laravel Passport to authenticate API requests from the client. You are also required to provide Stripe API test keys in the `.env` file.

## Assumptions

- A driver will enter the garage immediately when they request to enter and the gate opens
- There is only one garage (one garage per deployed app)
- There is only one gate
- AllDayRate will be paid for any ticket duration more than 6 hours, for the one price, the user could stay for an arbitrarily large amount of time and still pay the same as 7 hours
- "In-and-outs" are not supported, the user pays for multiple tickets
- Stay 0 minutes? Still have to pay the OneHourRate
- The driver pays right before they're going to leave
- The driver leaves right away
- The driver won't want to extend the amount of time they stay in the garage after paying (we don't support multiple bills per time in the garage)

## Future considerations

- support Rates that depend on things other than duration (e.g. Time of Day, Weekend rates, frequent customer)
- support receiving multiple payments for one visit to the garage (this unlocks a number of other features)
- allow the user to select their own ticket type up front
- have the user pay up front 
- give a free grace period where the user can leave without paying if they were X minutes or less (this involves more than a $0 rate, as we will want to skip the payment step)
- give users only X minutes after paying for them to get out of the garage.
- let the user lift the gate multiple times
- multiple garages in one app
- multiple gates in a garage
- more rules for entering and exiting
- store Rates in the database instead of as code
- expose the garage available spots api to show users how many spots are left before they try to enter

## Known bugs

- it's possible to double pay by opening the page in two tabs
- if the user pays but doesn't leave, the rate description will change as higher rates become applicable. The "paid amount" shown in the ticket information will remain the amount paid by the customer.

## Known areas for technical improvement

- Every rule is passed the user in it's constructor, but some don't require the user (e.g. GarageHasRoom), I would like to learn how to use Laravel's Service Container / resolver, as I am thinking this will allow the Rules to get the data they need by themselves instead of being passed.
- use mocks when testing the backend, right now even the Unit tests do a lot of Integration
- Vue components are not currently tested, I would like to learn how to do this
- Vue child components are being passed the ticket and user objects, maybe I could use VueX?
- Cache the Garage's number of remaining spots: faster than computing from the database
