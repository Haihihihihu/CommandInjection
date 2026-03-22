#!/usr/bin/perl
# Script giả lập kiểm tra tồn kho
# Usage: stockreport.pl <productId> <storeId>

my $productId = $ARGV[0] || "0";
my $storeId = $ARGV[1] || "0";

# Giả lập kết quả kiểm tra
my $units = int(rand(100)) + 10;

print "$units units\n";
