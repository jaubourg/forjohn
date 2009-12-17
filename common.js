function testLoad(number) {
	var service = number ? "service"+number+".php" : "failing-service.php",
		method = number ? "transform"+number : "alert";
	doTestLoad(service,method);
}