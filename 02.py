import glob
import os
import sys
import re

keepFiles={}
#HTMLからjpgのファイル名を抽出する．
for html_file  in glob.glob('**/*.html',recursive=True):
  #print(html_file)
  with open(html_file,"r") as F:
      lines = F.read()
      print(lines)
      lines = lines.replace('http://poliinfo2.github.io/','./')
      print(lines)
  with open(html_file,"w") as F:
      print(lines,file=F)

