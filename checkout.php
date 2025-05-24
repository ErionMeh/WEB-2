<?php
include('includes/header.php');

// Check if the user is logged in
if (!isset($_SESSION['user']['id'])) {
    $_SESSION['error_message'] = "You must log in to complete the purchase.";
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user']['id'];
$cart = $_SESSION['cart'] ?? [];

// Initialize variables
$error = '';
$success = '';
$formData = [
    'fullname' => '',
    'email' => '',
    'phone' => '',
    'address' => '',
    'notes' => '',
    'delivery_date' => ''
];

// Form processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve and sanitize form data
        $formData = [
            'fullname' => trim($_POST['fullname'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'address' => trim($_POST['address'] ?? ''),
            'notes' => trim($_POST['notes'] ?? ''),
            'delivery_date' => trim($_POST['delivery_date'] ?? '')
        ];

        // Validation
        if (empty($formData['fullname'])) {
            throw new Exception("Full name is required.");
        }

        if (empty($formData['email'])) {
            throw new Exception("Email is required.");
        }

        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (empty($formData['phone'])) {
            throw new Exception("Phone number is required.");
        }

        if (empty($formData['address'])) {
            throw new Exception("Address is required.");
        }

        if (empty($formData['delivery_date'])) {
            throw new Exception("Delivery date is required.");
        }

        if (!preg_match("/^\d{2}-\d{2}-\d{4}$/", $formData['delivery_date'])) {
            throw new Exception("Date must be in format <strong>dd-mm-yyyy</strong>.");
        }

        if (empty($cart)) {
            throw new Exception("Your cart is empty.");
        }

        // If validation passes
        $success = "Thank you for your order! Delivery date: <strong>" . 
                   htmlspecialchars($formData['delivery_date']) . "</strong>";
        
        // Log the order
        require_once 'classes/logger.php';
        shkruajNeLog("User with ID $userId placed an order with " . count($cart) . " items.");
        
        // Clear the cart
        $_SESSION['cart'] = [];
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="checkout py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Checkout</h2>
            <?php if (!empty($cart)): ?>
                <a href="update_cart.php?action=empty" class="btn btn-sm btn-outline-danger" 
                   onclick="return confirm('Are you sure you want to clear the cart?')">
                    Clear Cart
                </a>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Personal Information</h4>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" 
                                           value="<?= htmlspecialchars($formData['fullname']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" 
                                           value="<?= htmlspecialchars($formData['email']) ?>" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" 
                                           value="<?= htmlspecialchars($formData['phone']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="delivery_date" class="form-label">Delivery Date</label>
                                    <input type="text" name="delivery_date" id="delivery_date" class="form-control" 
                                           placeholder="dd-mm-yyyy" 
                                           value="<?= htmlspecialchars($formData['delivery_date']) ?>" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3" required><?= 
                                    htmlspecialchars($formData['address']) ?></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="notes" class="form-label">Additional Notes (optional)</label>
                                <textarea name="notes" id="notes" class="form-control" rows="2"><?= 
                                    htmlspecialchars($formData['notes']) ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Order Summary</h4>
                        
                        <?php if (!empty($cart)): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach ($cart as $item): 
                                            $itemTotal = $item['price'] * $item['qty'];
                                            $total += $itemTotal;
                                        ?>
                                            <tr>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= $item['qty'] ?></td>
                                                <td><?= number_format($itemTotal, 2) ?> €</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2">Total:</th>
                                            <th><?= number_format($total, 2) ?> €</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">Your cart is currently empty.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
