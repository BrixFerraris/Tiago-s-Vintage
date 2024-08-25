import turtle as t

t.setup(800, 800)
t.turtlesize(2,2,2)
t.speed(0)
t.setpos(0, -200)

def rel_pos(x, y):
  t.up()
  t.goto(t.pos()+(x, y))
  t.down()
    
def go_to(x, y):
  t.up()
  t.goto(x, y)
  t.down()
    
def fill_circle(radius, angle=360):
  t.begin_fill()
  t.circle(radius, angle)
  t.end_fill()
    
def draw_oval(width, height, color, x, y, fill=True):
  t.penup()
  t.goto(x, y)
  t.pendown()
  t.color(color)
  if fill:
    t.begin_fill()
    for i in range(2):
      t.circle(height/2, 45)
      t.circle(width/2, 135)
    if fill:
      t.end_fill()
        
def head():
    fill_circle(200)
    fill_circle(200, 135)
    cur_pos = t.pos()
    draw_oval(-180, -350, 'black', cur_pos[0], cur_pos[1])
    t.circle(200, 90)
    cur_pos = t.pos()
    t.seth(45)
    draw_oval(180, 350, 'black', cur_pos[0], cur_pos[1])
    t.seth(125)
    draw_oval(-160, -400, '#f5c697', -100, -40)
    t.seth(55)
    draw_oval(160, 400, '#f5c697', 100, -40)
    
    t.seth(160)
    draw_oval(-110, -460, '#f5c697', -50, -190)
    t.seth(20)
    draw_oval(110, 460, '#f5c697', 50, -190)
    t.seth(-115)
    draw_oval(160, 300, '#f5c697', -80, -50)
    
def eyes():
    t.width(8)
    t.seth(80)
    draw_oval(40, 220, 'black', -10, 0, False)
    t.left(1)
    draw_oval(10, 100, 'black', -15, -10)
    t.seth(90)
    draw_oval(-40, -220, 'black', 10, 0, False)
    t.right(1)
    draw_oval(-10, -100, 'black', 15, -10)
    
def nose():
  t.width(8)
  go_to(-55, -25)
  t.seth(18)
  t.circle(-150, 40)
  t.seth(20)
  draw_oval(-50, -110, 'black', -20, -35)
  
def mouth():
  t.seth(-60)
  go_to(-140, -40)
  t.circle(170, 118)
  
  t.seth(135)
  t.circle(20, 45)
  t.seth(10)
  t.circle(-20, 90)
  
  go_to(-140, -40)
  t.seth(45)
  t.circle(-20, 45)
  t.seth(-180)
  t.circle(20, 90)
  
  t.begin_fill()
  t.seth(-65)
  go_to(-140, -40)
  t.circle(170, 30)
  dila = t.pos()
  
  t.seth(-90)
  t.circle(80, 175)
  t.seth(25)
  t.circle(170, 30)
  t.seth(-125)
  t.circle(-170, 116)
  t.end_fill()
  
  t.goto(dila)
  t.fillcolor('red')
  t.seth(-90)
  t.circle(80, 40)
  t.begin_fill()
  t.circle(80, 100)
  t.seth(135)
  t.circle(45, 80)
  t.seth(150)
  t.circle(60, 68)
  t.end_fill()
  
def draw_mickey():
  head()
  eyes()
  nose()
  mouth()
  
draw_mickey()

t.hideturtle()
t.done()
    