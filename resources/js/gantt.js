// config
gantt.config.readonly = true;
gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
gantt.config.columns = [
    // columns set to task name only
    {name:"task", label:"Phases", width:"*", min_width: 1, align:"center"},
];

gantt.config.scale_height = 30*2;
gantt.config.min_column_width = 50;

gantt.config.scale_unit = "day";
gantt.config.subscales = [{ unit:"month", date:"%M %Y"	}];

gantt.config.layout = {
    css: "gantt_container",
    cols: [
        {
        width:400,
        minWidth: 200,
        maxWidth: 600,
        rows:[
            {view: "grid", scrollX: "gridScroll", scrollable: true, scrollY: "scrollVer"}, 

            // horizontal scrollbar for the grid
            {view: "scrollbar", id: "gridScroll", group:"horizontal"} 
        ]
        },
        {resizer: true, width: 1},
        {
        rows:[
            {view: "timeline", scrollX: "scrollHor", scrollable: true, scrollY: "scrollVer"},

            // horizontal scrollbar for the timeline
            {view: "scrollbar", id: "scrollHor", group:"horizontal"}  
        ]
        },
        {view: "scrollbar", id: "scrollVer"}
    ]
};

// config

function scrollResourceTimeline(x, y) {
    const currentX = gantt.getLayoutView("scrollHor2").$view.scrollLeft;
    const currentY = gantt.getLayoutView("scrollVer2").$view.scrollTop;
    gantt.scrollLayoutCell("resourceTimeline", currentX + x, currentY + y);
}

// gantt left side
gantt.templates.grid_folder = function(item) {
    // icon set to none
    return "";
};

gantt.templates.grid_row_class = function( start, end, task ){
    if ( task.$level > 1 ){
        return "nested_task"
    }
    return "";
};
// gantt left side

// gantt right side

gantt.templates.task_text=function(start, end, task){
    return task.task;
};

// gantt right side

gantt.init("gantt_here");

gantt.load("/tasks");
