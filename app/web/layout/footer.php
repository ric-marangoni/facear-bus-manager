						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo JSPATH ?>flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo JSPATH ?>flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="<?php echo JSPATH ?>flot/jquery.flot.resize.js"></script>
<script type="text/javascript">
$(function(){
	var e = {
		showTooltip:function(f,h,g){
			$('<div class="bolt_tips">'+g+"</div>")
			.css({
				position:"absolute",
				display:"none",
				top:h+5,
				left:f+5
			})
			.appendTo("body")
			.fadeIn(200)
		}};
	
	if(!!$(".plots").offset()){
		var a=[];
		var d=[];
		for(var b=0;b<=20;b+=0.5){
			a.push([b,Math.sin(b)]);
			d.push([b,Math.cos(b)])
		}
		
		$.plot(
			$(".plots"),
			[{label:"Cos",data:d},{label:"Sin",data:a}],
			{
				colors:["#00AADD","#FF6347"],
				series:{
					lines:{
						show:true,
						lineWidth:2
					},
					points:{
						show:true
					},
					shadowSize:2
				},
				grid:{
					hoverable:true,
					show:true,
					borderWidth:0,
					labelMargin:12
				},
				legend:{
					show:true,
					margin:[0,-24],
					noColumns:0,
					labelBoxBorderColor:null
				},
				yaxis:{
					min:-1.2,
					max:1.2
				},
				xaxis:{}});
			
			var c=null;
			
			$(".plots").bind("plothover",function(h,j,g){
				if(g){
					if(c!=g.dataIndex){
						c=g.dataIndex;
						$(".charts_tooltip").fadeOut("fast").promise().done(function(){
							$(this).remove()
						});
						
						var 
						f=g.datapoint[0].toFixed(2),
						i=g.datapoint[1].toFixed(2);
						
						e.showTooltip(g.pageX,g.pageY,g.series.label+" of "+f+" = "+i)
					}
				}else{
					$(".bolt_tips").fadeOut("fast").promise().done(function(){
						$(this).remove()
					});
					
					c=null
				}
			})}});
		</script>
		<div class="footer_wrapper">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="footer"><a href="http://www.mrisoft.com.br/" target="_blank">
							&copy; MRI Smart Systems</a> - Todos os direitos reservados.
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo JSPATH ?>bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.uniform.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>chosen.jquery.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.validationEngine-en.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.validationEngine.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>jquery.dataTables.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>fullcalendar.js"></script>
        <script type="text/javascript" src="<?php echo JSPATH ?>settings.js"></script>
		<script type="text/javascript" src="<?php echo JSPATH ?>script.js"></script>       		
    </body>
</html>