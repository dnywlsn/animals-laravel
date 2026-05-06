<!DOCTYPE html>
<html>
<head>
    <title>Adoption Inquiry</title>
</head>
<body>
    <h1>New Inquiry Received</h1>
    <p>User <strong><?php echo e($user->name); ?></strong> (<?php echo e($user->email); ?>) is interested in adopting <strong><?php echo e($animal->name); ?></strong>.</p>
    <p>Animal Species: <?php echo e($animal->species); ?></p>
    <p>Please follow up with the user as soon as possible.</p>
    <hr>
    <p>This is an automated message from Astana Animal Shelter.</p>
</body>
</html>
<?php /**PATH /Users/oralbek/Desktop/aizhan-project/resources/views/emails/inquiry.blade.php ENDPATH**/ ?>