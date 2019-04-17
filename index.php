$years = 3;
$earn = 3500;
$interest = 7.64;
$interest2 = 13;
$total = 465000;
$withdraw = 0;
$fee = 177;
$totalfee = 0;
$totalinterest = 0;
$totaltaxback = 0;

if($total>0) $withdraw = $total;
for($i = 0; $i<$years*2; $i++){
	for($j = 0; $j<6; $j++){
		$html.=($i*6+$j+1).' J)	'.round($total)." + ".($earn-$fee)." = ".round($total+$earn-$fee)."\r\n";
		$total+=$earn-$fee;
		$withdraw+=$earn;
		$totalfee+=$fee;
	}
	$html.=($i*6+$j).' I)	'.round($total)." + ".round($total*($interest/100))."(".($interest).")%\r\n";
	$totalinterest+=$total*($interest/100);
	$total=$total*(1+$interest/100);
	if($i%2==1) {
		$html.=(($i+1)/2).' Y)	'.round($total)." + ".($withdraw>400000?52000:$withdraw*($interest2/100))."(".($interest2).")%\r\n";
		$total+=$withdraw*($interest2/100);
		$totaltaxback+=($withdraw>400000?52000:$withdraw*($interest2/100));
		$withdraw = 0;
	}
}

$html.='\nTotal fee: '.$totalfee;
$html.='\nTotal interest: '.round($totalinterest);
$html.='\nTotal taxback: '.round($totaltaxback);
$html.='\nDelta income per '.$years.' years: '.round($totaltaxback+$totalinterest-$totalfee)."\n";
$html.='\nIf you will not save and will spend all your money, I\'ll have 0 after '.$years.' years.\nBut if you will withdraw at least '.$earn.' per month with '.$interest.' of interest for '.$years.' years - you\'ll have a '.round($totaltaxback+$totalinterest-$totalfee)." of revenue and ".round($total)." of savings\r\n";
return $html
