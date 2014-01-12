        <?php 
		if($this->messageArraySize > 0){ 
		?>
		<script>
        	jQuery(function(){ //for the notifications
            	$(document).ready(function(){
                	$.feedback({minToStack: 3}).addMessage({
                    	title: $('#messageTitle').val(),
                        message: $('#message').val(),
                        color: $('#color').val()
            		});
            	});
             	<?php $this->printMessages(); ?>
 	       });
    	</script>
        <?php 
		} 
		if(!$simpleFooter){ 
		?>
		<script>
        $(document).ready(function () {
            var s1 = [[2002, 112000], [2003, 122000], [2004, 104000], [2005, 99000], [2006, 121000],
            [2007, 148000], [2008, 114000], [2009, 133000], [2010, 161000]];
            var s2 = [[2002, 10200], [2003, 10800], [2004, 11200], [2005, 11800], [2006, 12400],
            [2007, 12800], [2008, 13200], [2009, 12600], [2010, 13100]];
         
            plot1 = $.jqplot("chart1", [s2, s1], {
                // Turns on animatino for all series in this plot.
                animate: true,
                // Will animate plot on calls to plot1.replot({resetAxes:true})
                animateReplot: true,
                cursor: {
                    show: true,
                    zoom: true,
                    looseZoom: true,
                    showTooltip: false
                },
                series:[
                    {color: '#729F00',
                        pointLabels: {
                            show: true
                        },
                        renderer: $.jqplot.BarRenderer,
                        showHighlight: false,
                        yaxis: 'y2axis',
                        rendererOptions: {
                            // Speed up the animation a little bit.
                            // This is a number of milliseconds. 
                            // Default for bar series is 3000. 
                            animation: {
                                speed: 2500
                            },
                            barWidth: 15,
                            barPadding: -15,
                            barMargin: 0,
                            highlightMouseOver: false
                        }
                    },
                    {     color: '#D92316',
                        rendererOptions: {
                            // speed up the animation a little bit.
                            // This is a number of milliseconds.
                            // Default for a line series is 2500.
                            animation: {
                                speed: 2000
                            }
                        }
                    }
                ],
                axesDefaults: {
                    pad: 0
                },
                axes: {
                    // These options will set up the x axis like a category axis.
                    xaxis: {
                        tickInterval: 1,
                        drawMajorGridlines: false,
                        drawMinorGridlines: false,
                        drawMajorTickMarks: false,
                        rendererOptions: {
                        tickInset: 0.5,
                        minorTicks: 1
                    }
                    },
                    yaxis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }
                    },
                    y2axis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            // align the ticks on the y2 axis with the y axis.
                            alignTicks: true,
                            forceTickAt0: true
                        }
                    }
                },
                grid: {
                    drawGridLines: false,        // wether to draw lines across the grid or not.
                    gridLineColor: 'rgba(0,0,0,0)',    // *Color of the grid lines.
                    background: 'rgba(0,0,0,0)',      // CSS color spec for background color of grid.
                    borderColor: '',     // CSS color spec for border around grid.
                    borderWidth: 0,           // pixel width of border around grid.
                    shadow: false,               // draw a shadow for grid.
                    shadowAngle: 45,            // angle of the shadow.  Clockwise from x axis.
                    shadowOffset: 1.5,          // offset from the line of the shadow.
                    shadowWidth: 3,             // width of the stroke for the shadow.
                    shadowDepth: 3,             // Number of strokes to make when drawing shadow.
                                                // Each stroke offset by shadowOffset from the last.
                    shadowAlpha: 0.07           // Opacity of the shadow
                },
                highlighter: {
                    show: true,
                    showLabel: true,
                    tooltipAxes: 'y',
                    sizeAdjust: 7.5 , tooltipLocation : 'ne'
                }
            });
            $('#chart1').data('plot', plot1);
            

            var bs1 = [[2002, 102000], [2003, 22000], [2004, 104000], [2005, 49000], [2006, 3000],
            [2007, 108000], [2008, 114000], [2009, 13000], [2010, 4000]];
            var bs2 = [[2002, 10200], [2003, 2800], [2004, 11200], [2005, 11800], [2006, 2400],
            [2007, 12800], [2008, 13200], [2009, 2600], [2010, 3100]];
         
            plot2 = $.jqplot("chart2", [bs2, bs1], {
                // Turns on animatino for all series in this plot.
                animate: true,
                animateReplot: true,
                cursor: {
                    show: true,
                    zoom: true,
                    looseZoom: true,
                    showTooltip: false
                },
                series:[
                    {color: '#729F00',
                        pointLabels: {
                            show: true
                        },
                        renderer: $.jqplot.BarRenderer,
                        showHighlight: false,
                        yaxis: 'y2axis',
                        rendererOptions: {
                            // Speed up the animation a little bit.
                            // This is a number of milliseconds. 
                            // Default for bar series is 3000. 
                            animation: {
                                speed: 2500
                            },
                            barWidth: 15,
                            barPadding: -15,
                            barMargin: 0,
                            highlightMouseOver: false
                        }
                    },
                    {     color: '#D92316',
                        rendererOptions: {
                            // speed up the animation a little bit.
                            // This is a number of milliseconds.
                            // Default for a line series is 2500.
                            animation: {
                                speed: 2000
                            }
                        }
                    }
                ],
                axesDefaults: {
                    pad: 0
                },
                axes: {
                    // These options will set up the x axis like a category axis.
                    xaxis: {
                        tickInterval: 1,
                        drawMajorGridlines: false,
                        drawMinorGridlines: false,
                        drawMajorTickMarks: false,
                        rendererOptions: {
                        tickInset: 0.5,
                        minorTicks: 1
                    }
                    },
                    yaxis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }
                    },
                    y2axis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            // align the ticks on the y2 axis with the y axis.
                            alignTicks: true,
                            forceTickAt0: true
                        }
                    }
                },
                grid: {
                    drawGridLines: false,        // wether to draw lines across the grid or not.
                    gridLineColor: 'rgba(0,0,0,0)',    // *Color of the grid lines.
                    background: 'rgba(0,0,0,0)',      // CSS color spec for background color of grid.
                    borderColor: '',     // CSS color spec for border around grid.
                    borderWidth: 0,           // pixel width of border around grid.
                    shadow: false,               // draw a shadow for grid.
                    shadowAngle: 45,            // angle of the shadow.  Clockwise from x axis.
                    shadowOffset: 1.5,          // offset from the line of the shadow.
                    shadowWidth: 3,             // width of the stroke for the shadow.
                    shadowDepth: 3,             // Number of strokes to make when drawing shadow.
                                                // Each stroke offset by shadowOffset from the last.
                    shadowAlpha: 0.07           // Opacity of the shadow
                },
                highlighter: {
                    show: true,
                    showLabel: true,
                    tooltipAxes: 'y',
                    sizeAdjust: 7.5 , tooltipLocation : 'ne'
                }
            });
            $('#chart2').data('plot', plot2);
            
            var cs1 = [[2002, 2000], [2003, 102000], [2004, 104000], [2005, 49000], [2006, 10000],
            [2007, 108000], [2008, 114000], [2009, 113000], [2010, 14000], [2010, 73000]];
            var cs2 = [[2002, 2000], [2003, 12800], [2004, 11200], [2005, 11800], [2006, 12400],
            [2007, 12800], [2008, 13200], [2009, 12600], [2010, 13100]];
         
            plot3 = $.jqplot("chart3", [cs2, cs1], {
                // Turns on animatino for all series in this plot.
                animate: true,
                animateReplot: true,
                cursor: {
                    show: true,
                    zoom: true,
                    looseZoom: true,
                    showTooltip: false
                },
                series:[
                    {color: '#729F00',
                        pointLabels: {
                            show: true
                        },
                        renderer: $.jqplot.BarRenderer,
                        showHighlight: false,
                        yaxis: 'y2axis',
                        rendererOptions: {
                            // Speed up the animation a little bit.
                            // This is a number of milliseconds. 
                            // Default for bar series is 3000. 
                            animation: {
                                speed: 2500
                            },
                            barWidth: 15,
                            barPadding: -15,
                            barMargin: 0,
                            highlightMouseOver: false
                        }
                    },
                    {     color: '#D92316',
                        rendererOptions: {
                            // speed up the animation a little bit.
                            // This is a number of milliseconds.
                            // Default for a line series is 2500.
                            animation: {
                                speed: 2000
                            }
                        }
                    }
                ],
                axesDefaults: {
                    pad: 0
                },
                axes: {
                    // These options will set up the x axis like a category axis.
                    xaxis: {
                        tickInterval: 1,
                        drawMajorGridlines: false,
                        drawMinorGridlines: false,
                        drawMajorTickMarks: false,
                        rendererOptions: {
                        tickInset: 0.5,
                        minorTicks: 1
                    }
                    },
                    yaxis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }
                    },
                    y2axis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            // align the ticks on the y2 axis with the y axis.
                            alignTicks: true,
                            forceTickAt0: true
                        }
                    }
                },
                grid: {
                    drawGridLines: false,        // wether to draw lines across the grid or not.
                    gridLineColor: 'rgba(0,0,0,0)',    // *Color of the grid lines.
                    background: 'rgba(0,0,0,0)',      // CSS color spec for background color of grid.
                    borderColor: '',     // CSS color spec for border around grid.
                    borderWidth: 0,           // pixel width of border around grid.
                    shadow: false,               // draw a shadow for grid.
                    shadowAngle: 45,            // angle of the shadow.  Clockwise from x axis.
                    shadowOffset: 1.5,          // offset from the line of the shadow.
                    shadowWidth: 3,             // width of the stroke for the shadow.
                    shadowDepth: 3,             // Number of strokes to make when drawing shadow.
                                                // Each stroke offset by shadowOffset from the last.
                    shadowAlpha: 0.07           // Opacity of the shadow
                },
                highlighter: {
                    show: true,
                    showLabel: true,
                    tooltipAxes: 'y',
                    sizeAdjust: 7.5 , tooltipLocation : 'ne'
                }
            });
            $('#chart3').data('plot', plot3);
            
            var ds1 = [[2002, 12000], [2003, 102000], [2004, 104000], [2005, 9000], [2006, 10000],
            [2007, 108000], [2008, 114000], [2009, 113000], [2010, 14000]];
            var ds2 = [[2002, 12000], [2003, 12800], [2004, 11200], [2005, 1800], [2006, 12400],
            [2007, 12800], [2008, 13200], [2009, 12600], [2010, 13100]];
         
            plot4 = $.jqplot("chart4", [ds2, ds1], {
                // Turns on animatino for all series in this plot.
                animate: true,
                animateReplot: true,
                cursor: {
                    show: true,
                    zoom: true,
                    looseZoom: true,
                    showTooltip: false
                },
                series:[
                    {color: '#729F00',
                        pointLabels: {
                            show: true
                        },
                        renderer: $.jqplot.BarRenderer,
                        showHighlight: false,
                        yaxis: 'y2axis',
                        rendererOptions: {
                            // Speed up the animation a little bit.
                            // This is a number of milliseconds. 
                            // Default for bar series is 3000. 
                            animation: {
                                speed: 2500
                            },
                            barWidth: 15,
                            barPadding: -15,
                            barMargin: 0,
                            highlightMouseOver: false
                        }
                    },
                    {     color: '#D92316',
                        rendererOptions: {
                            // speed up the animation a little bit.
                            // This is a number of milliseconds.
                            // Default for a line series is 2500.
                            animation: {
                                speed: 2000
                            }
                        }
                    }
                ],
                axesDefaults: {
                    pad: 0
                },
                axes: {
                    // These options will set up the x axis like a category axis.
                    xaxis: {
                        tickInterval: 1,
                        drawMajorGridlines: false,
                        drawMinorGridlines: false,
                        drawMajorTickMarks: false,
                        rendererOptions: {
                        tickInset: 0.5,
                        minorTicks: 1
                    }
                    },
                    yaxis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            forceTickAt0: true
                        }
                    },
                    y2axis: {
                        tickOptions: {
                            formatString: "$%'d"
                        },
                        rendererOptions: {
                            // align the ticks on the y2 axis with the y axis.
                            alignTicks: true,
                            forceTickAt0: true
                        }
                    }
                },
                grid: {
                    drawGridLines: false,        // wether to draw lines across the grid or not.
                    gridLineColor: 'rgba(0,0,0,0)',    // *Color of the grid lines.
                    background: 'rgba(0,0,0,0)',      // CSS color spec for background color of grid.
                    borderColor: '',     // CSS color spec for border around grid.
                    borderWidth: 0,           // pixel width of border around grid.
                    shadow: false,               // draw a shadow for grid.
                    shadowAngle: 45,            // angle of the shadow.  Clockwise from x axis.
                    shadowOffset: 1.5,          // offset from the line of the shadow.
                    shadowWidth: 3,             // width of the stroke for the shadow.
                    shadowDepth: 3,             // Number of strokes to make when drawing shadow.
                                                // Each stroke offset by shadowOffset from the last.
                    shadowAlpha: 0.07           // Opacity of the shadow
                },
                highlighter: {
                    show: true,
                    showLabel: true,
                    tooltipAxes: 'y',
                    sizeAdjust: 7.5 , tooltipLocation : 'ne'
                }
            });
            $('#chart4').data('plot', plot4);
           
        });
        </script>
        <?php } ?>
        </div>
    </body>
</html>