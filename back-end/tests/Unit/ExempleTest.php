<?php

test('exemple', function () {
  $test = 1 + 2;

  expect($test)->toBe(3);
});