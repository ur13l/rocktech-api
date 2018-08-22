<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="eventbrite-widget-container-49395261557"></div>
    <script src="https://www.eventbrite.com/static/widgets/eb_widgets.js"></script>
    <script type="text/javascript">
    var exampleCallback = function() {
        console.log('Order complete!');
        };
        window.EBWidgets.createWidget({
        // Required
        widgetType: 'checkout',
        eventId: '49395261557',
        iframeContainerId: 'eventbrite-widget-container-49395261557',
        // Optional
        iframeContainerHeight: 425,  // Widget height in pixels. Defaults to a minimum of 425px if not provided
        onOrderComplete: exampleCallback  // Method called when an order has successfully completed
    });
  </script>
</body>
</html>
