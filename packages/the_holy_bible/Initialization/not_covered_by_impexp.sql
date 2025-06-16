#######################################
### Default data for ImpExp
### Preset for Solr development site : THE HOLY BIBLE

INSERT INTO pages
  (uid, pid, tstamp, crdate, deleted, hidden, starttime, endtime, fe_group, sorting, editlock, sys_language_uid, l10n_parent, l10n_source, perms_userid, perms_groupid, perms_user, perms_group, sitemap_priority, doktype, title, slug, no_search, is_siteroot, bnumber)
VALUES
	(100, 0, 1751622828, 1751622828, 0, 0, 0, 0, '', 128, 0, 0, 0, 0, 1, 1, 31, 31, 0.5, 1, 'THE HOLY BIBLE', '/', 1, 1, 0),
  (101, 0, 1751622828, 1751622828, 0, 0, 0, 0, '', 128, 0, 1, 100, 100, 1, 1, 31, 31, 0.5, 1, 'Die Bibel', '/', 1, 1, 0),
	(102, 0, 1751622828, 1751622828, 0, 0, 0, 0, '', 128, 0, 2, 100, 100, 1, 1, 31, 31, 0.5, 1, 'Библия', '/', 1, 1, 0);

