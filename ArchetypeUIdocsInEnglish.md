# ArchetypeUI v.0.2.1 #

## 1.0.0 Description of the modules ##
### 1.1.0 GUI - graphical user interfaces ###
> The **GUI** subpackage is the one of the main elements of the package **ArchetypeUI**, it contains modules witch allow to create drawn graphical user interfaces for **PyS60** applications.
> The subpackage in the current **version 0.3.1** contains only **GTextParser** module.
### 1.1.1 GTextParser module ###
> The **GTextParser** module is the text parser and it allows to make parameter calculation for text output on graphics.
**Class Parser(cloth, text, size = None, text\_font = "normal", position = 0, struct = {}, scaner\_callback = lambda TextLen, CurrentPosition: None, calc\_auto = 1)**
> Creates a Parser object.

**cloth**
> A _**graphics.Image**_ object or some other analog object.
**text**
> A text given for handling. Must be _**Unicode**_.
**size**
> The optional parameter. A tuple consisted of two integers meaning width and height of the area on witch text output will be done in pixels. If size is set to _**None**_, the said sizes will be taken from the cloth argument. On-default the size value is set to _**None**_.
**text\_font**
> The optional parameter. The text font. Supported all the ways of font setting supported by the **cloth** object. On-default the **text\_font** value is set to _**’normal’**_.
**position**
> The optional parameter. An index of a symbol from witch you want to output the text. Must be integer. On-default the **position** value is set to _**0**_.
**struct**
> The optional parameter. The dictionary containing datas witch cancel need of calculation of large part of parameters. For more information look below in the description of attributes.
**scaner\_callback**
> The optional parameter. Calling object (function) receiving two arguments. This function is assigned for visualization and tracking of the parameter calculation process. The first argument is a common number of symbols in the **text**, the second argument is the scaner position in the **text**. **scaner\_callback** is called after every scanning cycle finish. On-default is passed the empty function witch do nothing.
**calc\_auto**
> The optional parameter. On-default has value of _**1**_. If it has value of _**1**_, at the **Parser** object creation is called **Calcsets()** method. If **calc\_auto** has value of _**0**_, after **Parser** object creation it is necessary to call **Calcsets()** method.

### Parser type ###
### Instances of Parser type have the following attributes: ###
**cloth**
> A _**graphics**_.Image object or some other analog object. Read and write.
**text**
> A text assigned for handling. Must be _**Unicode**_. Read and write. After giving new value to the attribute it is necessary to call **Calcsets()** method.
**size**
> A tuple consisted of two integers meaning width and height of the area in pixels on witch text output will be done. Read and write. After giving new value to the attribute it is necessary to call **Calcsets()** method.
**text\_font**
> A text font. Supported all the ways of font setting supported by the **cloth** object. Read and write. After giving new value to the attribute it is necessary to call **Calcsets()** method.
**position**
> An index of a symbol, current text position. Must recieve only integers. Read and write. If the text attribute has value of _**u""**_ (empty string), **position** returns _**0**_. After giving new value to **position** it is necessary to call **Reload()** method.
> You are not obliged to call **Calcsets()** method after changing every attribute of **text**, **size** and **text\_font**. You can change several attributes and then call **Calcsets()** method.
For example,
```
from ArchetypeUI.GUI import GTextParser
from graphics import *
img = Image.new((176, 208))
gt = GTextParser.Parser(cloth = img, text = u"Hello world!", text_font = u"LatinPlain12") # we haven't set size, so it will be automatically recieved from img.size, h.e (176, 208)
gt.text = u"I love Python!"
gt.text_font = u"LatinBold17"
gt.Calcsets()
```
  * eload()**method calling is necessary in that case if you change only position attribute. If you change**position**together with**text**,**size**or**text\_font**, it is enought to call just**Calcsets()**.**struct**> Read and write. This attribute returns dictionary containing text layout table. Moreover, there contains information about text content, text font and text output width. The value recieved from**struct**can be used then at the**Parser**object creation. Also you can change value of**struct**attribute with the value recieved before. After giving new value to the attribute it is necessary to call**Calcsets()**method. Such treatment allows to accelerate re-calculation of all parameters after**text**,**size**and**text\_font**were changed.
For example,
```
from ArchetypeUI.GUI import GTextParser
from graphics import *
img = Image.new((240, 320))
gt = GTextParser.Parser(cloth = img, text = u"Hello world!", text_font = u"LatinPlain12", size = (120, 320))
str1 = gt.struct
gt2 = GTextParser.Parser(cloth = img, text = u"Hello world!", text_font = u"LatinPlain12", size = (120, 320), struct = str1)
gt.text = u"I love Python!"
gt.Calcsets()
gt.text = u"Hello world!"
gt.struct = str1
gt.Calcsets()
```**scaner\_callback**> Read and write. Calling object recieving two arguments. This function is assigned for visualization and tracking of the parameter calculation process. The first argument is a common number of symbols in the**text**, the second argument is the scaner position in the**text**.**scaner\_callback**is called after every scanning cycle finish.
For example,
```
from ArchetypeUI.GUI import GTextParser
from graphics import *
import appuifw
def visualization(TextLen, CurrentPosition):
    appuifw.app.title = u"%s " % int(float(CurrentPosition) / TextLen * 100) + u"%"
t = open("c:\\gpl.txt","rb")
txt = unicode(t.read())
t.close()
img = Image.new((240, 320))
gt = GTextParser.Parser(cloth = img, text = txt, text_font = u"LatinPlain12", size = (240, 320), scaner_callback = visualization)
print "OK"
```**text\_len**> A number of symbols in the**text**. Read only.**max**> A string height in pixels. Read only.**gap**> A distance between strings in pixels. Read only.**maxlen**> A maximal string length in pixels. Equal  to size`[0]`. Read only.**num\_str**> A number of strings placed on a area size. Read only.**start\_y**> y coordinate recommended for first string. Read only.**y\_coordinates**> A tuple containing y coordinates recommended for output of strings. Read only.**string\_list**> A tuple containing strings assigned for output. Read only.**string\_list\_q**> The integer meaning number of strings contained in string\_list. Read only.
### Instances of Parser type have follwing methods: ###**Calcsets()**> It makes calculations of the main parameters. It is necessary to call after changing of the attributes of**text**,**size**and**text\_font**, and also after**Parser**object creation if**calc\_auto**argument has value of 0.**Reload()**> It makes renewal of**string\_list**attribute after**position