base_dir = Dir.getwd
puts base_dir

puts File.mtime(__FILE__)
arr = []
str = Dir.each_child(base_dir)
str.each do |file|
  print "#{file} " unless File.fnmatch(".*", file)
end